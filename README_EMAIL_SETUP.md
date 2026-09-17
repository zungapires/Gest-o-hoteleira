# Configuração de E-mail e PDF

Este projeto usa CodeIgniter e gera confirmações de reserva em PDF para envio por e-mail.

## Passo 1: Configurar SMTP

Edite `application/config/email.php` ou use variáveis de ambiente:

- `EMAIL_PROTOCOL` - `smtp`, `mail` ou `sendmail`
- `SMTP_HOST` - servidor SMTP
- `SMTP_USER` - usuário SMTP
- `SMTP_PASS` - senha SMTP
- `SMTP_PORT` - porta SMTP (ex: `587`)
- `SMTP_CRYPTO` - `tls`, `ssl` ou vazio
- `EMAIL_FROM` - endereço remetente
- `EMAIL_FROM_NAME` - nome remetente
- `SENDMAIL_PATH` - caminho do sendmail, se usar `sendmail`

Você pode copiar `.env.example` para `.env` e usar `getenv()` no PHP.

## Passo 2: Instalar dependências de PDF

O projeto já instalou `dompdf/dompdf` via Composer. Se quiser usar fallback, instale `wkhtmltopdf` também:

```bash
composer require dompdf/dompdf
sudo apt-get install -y wkhtmltopdf
```

## Passo 3: Testar o fluxo

1. Crie ou atualize um quarto disponível em `admin/rooms`.
2. Faça uma reserva em `reservar` e confirme que o status do quarto muda para `reserved`.
3. Acesse `admin/reservations` e clique em `Enviar e-mail/PDF`.
4. Verifique se o PDF foi gerado em `storage/invoices/`.

## Observações

- Se `Dompdf` estiver disponível, ele será usado. Caso contrário, o sistema tentará `wkhtmltopdf`.
- O envio por e-mail depende da configuração correta do SMTP ou de um agente `sendmail` funcionando.
- Em caso de falha, verifique os logs do CodeIgniter e as mensagens retornadas pela rota AJAX.
