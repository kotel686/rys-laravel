@php
    /** @var \App\Models\ContactMessage $contactMessage */
@endphp

<!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <title>Nová zpráva z webu</title>
</head>
<body style="font-family: -apple-system, Segoe UI, Roboto, sans-serif; background: #f4f4f5; padding: 24px; margin: 0;">
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden;">
        <tr>
            <td style="background: hsl(220, 39%, 11%); color: #ffffff; padding: 20px 24px;">
                <h1 style="margin: 0; font-size: 18px; font-weight: 600;">
                    Nová zpráva z webu – {{ $contactMessage->sourceLabel() }}
                </h1>
                <p style="margin: 4px 0 0; font-size: 13px; opacity: 0.8;">
                    {{ $contactMessage->created_at->translatedFormat('j. F Y H:i') }}
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding: 24px;">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="font-size: 14px; color: #1f2937;">
                    <tr>
                        <td style="padding: 6px 0; color: #6b7280; width: 130px;">Jméno</td>
                        <td style="padding: 6px 0;">{{ $contactMessage->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 6px 0; color: #6b7280;">E-mail</td>
                        <td style="padding: 6px 0;"><a href="mailto:{{ $contactMessage->email }}" style="color: hsl(0, 75%, 43%); text-decoration: none;">{{ $contactMessage->email }}</a></td>
                    </tr>
                    @if ($contactMessage->phone)
                        <tr>
                            <td style="padding: 6px 0; color: #6b7280;">Telefon</td>
                            <td style="padding: 6px 0;"><a href="tel:{{ $contactMessage->phone }}" style="color: hsl(0, 75%, 43%); text-decoration: none;">{{ $contactMessage->phone }}</a></td>
                        </tr>
                    @endif
                </table>

                <div style="margin-top: 24px; padding: 16px; background: #f9fafb; border-radius: 6px; border: 1px solid #e5e7eb;">
                    <div style="font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">
                        Zpráva
                    </div>
                    <div style="font-size: 14px; color: #1f2937; line-height: 1.6; white-space: pre-line;">{{ $contactMessage->message }}</div>
                </div>

                <p style="margin: 24px 0 0; font-size: 12px; color: #6b7280; line-height: 1.5;">
                    Stačí na tento e-mail odpovědět – odpověď půjde přímo na adresu odesílatele.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
