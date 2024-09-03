<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Reminder</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <p>Hello <strong>{{$username}}</strong>,</p>
    
    <p>I hope you're doing well.</p>
    
    <p>This is a friendly reminder regarding the following task that was assigned earlier:</p>
    
    <table style="border-collapse: collapse; width: 100%; margin-bottom: 20px;">
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Details</th>
            <td style="border: 1px solid #ddd; padding: 8px;">{{$task}}</td>
        </tr>
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Due Date</th>
            <td style="border: 1px solid #ddd; padding: 8px;">{{$due_date}}</td>
        </tr>
    </table>
    
    <p>Please ensure that this task is completed by the due date. If you need any assistance or have any questions, feel free to reach out to me.</p>
    
    <p>Thank you for your cooperation.</p>
    
    <p>Best regards,<br>
    [Mohammed]</p>
</body>
</html>
