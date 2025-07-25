<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>New Contact Form Submission</h2>
    <table>
        <tr>
            <th>Name</th>
            <td>{{ $contact['name'] }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $contact['email'] }}</td>
        </tr>
        <tr>
            <th>Message</th>
            <td>{{ $contact['body'] }}</td>
        </tr>
    </table>
</body>
</html>
