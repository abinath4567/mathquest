<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
        }
        .form-container {
            width: 300px;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background: green;
            color: white;
        }
        button {
            width: 100%;
            padding: 10px;
            background: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add Student</h2>

    <form>
        <input type="text" placeholder="Enter student name">
        <input type="email" placeholder="Enter email">
        <input type="number" placeholder="Enter points" value="0">
        <button type="submit">Add Student</button>
    </form>
</div>

<!-- Student List -->
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Points</th>
    </tr>
    <tr>
        <td>1</td>
        <td>Ali</td>
        <td>ali@email.com</td>
        <td>10</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Siti</td>
        <td>siti@email.com</td>
        <td>20</td>
    </tr>
    <tr>
        <td>3</td>
        <td>John</td>
        <td>john@email.com</td>
        <td>15</td>
    </tr>
</table>

</body>
</html>
