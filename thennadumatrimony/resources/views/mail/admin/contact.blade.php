<!DOCTYPE html>
<html>
<head>
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
        <h2 style="color: #900C3F; border-bottom: 2px solid #900C3F; padding-bottom: 10px;">New Contact Message Received</h2>
        <p>You have received a new message from the contact form on your website.</p>
        
        <table style="width: 100%; margin-top: 20px;">
            <tr>
                <td style="font-weight: bold; width: 120px;">Name:</td>
                <td>{{ $contact->name }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Email:</td>
                <td>{{ $contact->email }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Subject:</td>
                <td>{{ $contact->subject ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; vertical-align: top;">Message:</td>
                <td>{{ $contact->message }}</td>
            </tr>
        </table>
        
        <p style="margin-top: 30px; font-size: 12px; color: #777;">This email was sent from the Thennadu Matrimony contact form.</p>
    </div>
</body>
</html>
