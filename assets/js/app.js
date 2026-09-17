document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.querySelector('.navbar-floating');
    const reservationForm = document.getElementById('reservationForm');

    window.addEventListener('scroll', function () {
        if (navbar) {
            navbar.classList.toggle('scrolled', window.scrollY > 30);
        }
    });

    if (reservationForm) {
        reservationForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const data = {
                guest_name: $('#guest_name').val(),
                guest_email: $('#guest_email').val(),
                guest_phone: $('#guest_phone').val(),
                guest_document: $('#guest_document').val(),
                type: $('#type').val(),
                guests: $('#guests').val(),
                check_in: $('#check_in').val(),
                check_out: $('#check_out').val(),
                arrival_time: $('#arrival_time').val(),
                pickup: $('input[name="pickup"]:checked').val(),
                special_requests: $('#special_requests').val()
            };

            if (!data.guest_name || !data.guest_email || !data.guest_phone || !data.guest_document || !data.type || !data.check_in || !data.check_out || !data.arrival_time) {
                Swal.fire({ icon: 'warning', title: 'Campos obrigatórios', text: 'Preencha todos os campos do formulário de reserva.' });
                return;
            }

            const doSubmit = function () {
                $.ajax({
                    url: window.appBaseUrl + 'book',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function (response) {
                        if (response.success) {
                            let html = '<p>' + response.message + '</p><p>Código: ' + (response.reservation_code || '') + '</p>';
                            if (response.email_sent) {
                                html += '<p>E-mail de confirmação enviado.</p>';
                            }
                            if (response.sms_sent) {
                                html += '<p>SMS de confirmação enviado para ' + data.guest_phone + '.</p>';
                            }
                            if (response.whatsapp_sent) {
                                html += '<p>Mensagem WhatsApp enviada para ' + data.guest_phone + '.</p>';
                            }
                            Swal.fire({ icon: 'success', title: 'Reserva enviada', html: html }).then(function () {
                                window.location.href = window.appBaseUrl + 'payment/checkout/' + response.reservation_id;
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Falha na reserva', text: response.message });
                        }
                    },
                    error: function () {
                        Swal.fire({ icon: 'error', title: 'Erro', text: 'Não foi possível processar sua reserva no momento.' });
                    }
                });
            };

            // If user is not authenticated, ask whether to login or continue as guest
            if (typeof window.isAuthenticated !== 'undefined' && !window.isAuthenticated) {
                Swal.fire({
                    title: 'Como deseja continuar?',
                    showCancelButton: true,
                    confirmButtonText: 'Reservar como Visitante',
                    cancelButtonText: 'Entrar na Minha Conta',
                    icon: 'question'
                }).then(function (result) {
                    if (result.isConfirmed) {
                        doSubmit();
                    } else {
                        window.location.href = window.appBaseUrl + 'login';
                    }
                });
            } else {
                doSubmit();
            }
        });
    }

    $(document).on('click', 'a.reserve-action', function (event) {
        const href = $(this).attr('href');
        if (!href) {
            return;
        }
        if (href.indexOf('/reservar') === -1 && href.indexOf('reservar') === -1) {
            return;
        }
        event.preventDefault();
        if (window.isAuthenticated) {
            window.location.href = href;
            return;
        }
        const modalEl = document.getElementById('reserveOptionModal');
        if (modalEl) {
            const reserveModal = new bootstrap.Modal(modalEl);
            reserveModal.show();
        } else {
            window.location.href = href;
        }
    });

    if (window.location.pathname.indexOf('/admin/rooms') !== -1) {
            const roomsTable = $('#roomsTable').DataTable({ pageLength: 8, lengthChange: false, searching: false });

            $('#roomStatusFilter').on('change', function () {
                roomsTable.column(6).search($(this).val()).draw();
            });

            $('#roomTypeFilter').on('keyup', function () {
                roomsTable.column(3).search($(this).val()).draw();
            });

            $('#roomNumberFilter').on('keyup', function () {
                roomsTable.column(1).search($(this).val()).draw();
            });
        const roomModal = new bootstrap.Modal(document.getElementById('roomModal'));
        let blockedPeriods = [];

        const renderBlockedList = (blocks) => {
            const list = $('#blockedPeriodsList');
            if (!Array.isArray(blocks) || blocks.length === 0) {
                list.html('<p class="text-muted">Nenhum bloqueio ativo.</p>');
                return;
            }
            const items = blocks.map((block, index) => {
                const note = block.note ? '<div class="text-muted small">' + block.note + '</div>' : '';
                return '<div class="d-flex justify-content-between align-items-center py-2 border-bottom border-white border-opacity-10">'
                    + '<div><strong>' + block.start_date + ' → ' + block.end_date + '</strong>' + note + '</div>'
                    + '<button type="button" class="btn btn-sm btn-outline-danger remove-block" data-index="' + index + '">Remover</button>'
                    + '</div>';
            });
            list.html(items.join(''));
        };

        const updateBlockedField = (blocks) => {
            $('#blocked_periods').val(JSON.stringify(blocks));
            renderBlockedList(blocks);
        };

        $('#addBlockPeriod').on('click', function () {
            const start = $('#block_start_date').val();
            const end = $('#block_end_date').val();
            const note = $('#block_note').val();
            if (!start || !end) {
                Swal.fire('Atenção', 'Defina início e fim do bloqueio.', 'warning');
                return;
            }
            if (start >= end) {
                Swal.fire('Atenção', 'A data de fim deve ser posterior à data de início.', 'warning');
                return;
            }
            blockedPeriods.push({ start_date: start, end_date: end, note });
            updateBlockedField(blockedPeriods);
            $('#block_start_date').val('');
            $('#block_end_date').val('');
            $('#block_note').val('');
        });

        $(document).on('click', '.remove-block', function () {
            const index = $(this).data('index');
            blockedPeriods.splice(index, 1);
            updateBlockedField(blockedPeriods);
        });

        $('#roomModal').on('hidden.bs.modal', function () {
            $('#roomForm')[0].reset();
            blockedPeriods = [];
            updateBlockedField(blockedPeriods);
        });

        $(document).on('click', '.edit-room', function () {
            const room = $(this).data('room');
            $('#room_id').val(room.id);
            $('#room_number').val(room.number || '');
            $('#room_name').val(room.name);
            $('#room_price').val(room.price);
            $('#room_capacity').val(room.capacity);
            $('#room_type').val(room.type);
            $('#room_status').val(room.status);
            $('#room_image').val(room.image);
            $('#room_description').val(room.description);
            blockedPeriods = Array.isArray(room.blocked_periods) ? room.blocked_periods : [];
            updateBlockedField(blockedPeriods);
            roomModal.show();
        });

        $('#saveRoom').on('click', function () {
            const data = $('#roomForm').serialize();
            $.ajax({
                url: window.appBaseUrl + 'rooms/save_ajax',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({ icon: 'success', title: 'Sucesso', text: response.message }).then(() => location.reload());
                    }
                }
            });
        });

        $(document).on('click', '.delete-room', function () {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Excluir quarto?',
                text: 'Esta ação não pode ser desfeita.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, excluir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: window.appBaseUrl + 'rooms/delete_ajax/' + id,
                        type: 'POST',
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                Swal.fire('Excluído', 'Quarto removido.', 'success').then(() => location.reload());
                            }
                        }
                    });
                }
            });
        });
    }

    if (window.location.pathname.indexOf('/admin/reservations') !== -1 || window.location.pathname.indexOf('/admin/clients') !== -1 || window.location.pathname.indexOf('/client/profile') !== -1) {
        $('table').DataTable({ pageLength: 8, lengthChange: false, ordering: true });
    }

    if (window.location.pathname.indexOf('/admin/reservations') !== -1) {
        $(document).on('click', '.confirm-reservation', function () {
            const id = $(this).data('id');
            $.post(window.appBaseUrl + 'reservations/confirm_ajax/' + id, {}, function (resp) {
                if (resp.success) location.reload();
                else Swal.fire('Erro', resp.message || 'Falha ao confirmar.', 'error');
            }, 'json');
        });

        $(document).on('click', '.cancel-reservation', function () {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Cancelar reserva?',
                text: 'Deseja realmente cancelar esta reserva?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, cancelar'
            }).then((res) => {
                if (res.isConfirmed) {
                    $.post(window.appBaseUrl + 'reservations/cancel_ajax/' + id, {}, function (resp) {
                        if (resp.success) location.reload();
                        else Swal.fire('Erro', resp.message || 'Falha ao cancelar.', 'error');
                    }, 'json');
                }
            });
        });

        $(document).on('click', '.email-reservation', function () {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Enviar confirmação por e-mail?',
                showCancelButton: true,
                confirmButtonText: 'Enviar'
            }).then((res) => {
                if (res.isConfirmed) {
                    $.post(window.appBaseUrl + 'reservations/send_pdf_ajax/' + id, {}, function (resp) {
                        if (resp.success) Swal.fire('Enviado', 'E-mail enviado ao cliente.', 'success');
                        else Swal.fire('Erro', resp.message || 'Falha ao enviar e-mail.', 'error');
                    }, 'json');
                }
            });
        });
    }

    if ($('#galleryCarousel').length) {
        const carousel = new bootstrap.Carousel('#galleryCarousel', { interval: 4500, ride: 'carousel', pause: false });
    }
});
