<!DOCTYPE html> 

<html>

<head>
    <title>MathQuest Login</title>

```
<style>
    body {
        font-family: Arial;
        background: linear-gradient(to right, rgb(52,152,219), rgb(155,89,182));
        text-align: center;
        color: white;
    }

    .login-box {
        background: white;
        color: black;
        width: 320px;
        margin: 100px auto;
        padding: 20px;
        border-radius: 10px;
    }

    input, select {
        width: 90%;
        padding: 10px;
        margin: 10px;
    }

    button {
        background-color: rgb(52,152,219);
        color: white;
        padding: 10px;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: rgb(155,89,182);
    }

    .error {
        color: red;
    }

    .info {
        font-size: 12px;
        color: grey;
    }
</style>
```

</head>

<body>

<div class="login-box">
    <h2>MathQuest Login</h2>

```
<input type="text" id="username" placeholder="Username"><br>
<input type="password" id="password" placeholder="Password"><br>

<select id="role">
    <option value="student">Student</option>
    <option value="teacher">Teacher</option>
</select><br>

<button onclick="login()">Login</button>

<p id="error" class="error"></p>

<p class="info">
    Demo Accounts:<br>
    Student: ali / 123<br>
    Student: brian / 456<br>
    Teacher: teacher1 / admin123
</p>
```

</div>

<script>
    // ✅ Admin-managed users
    let users = [
        {username: "admin", password: "123", role: "admin"},
        {username: "student", password: "456", role: "student"},
        {username: "teacher", password: "789", role: "teacher"}
    ];

    function login() {
        let user = document.getElementById("username").value.trim();
        let pass = document.getElementById("password").value.trim();
        let role = document.getElementById("role").value;

        let found = users.find(u => 
            u.username === user &&
            u.password === pass &&
            u.role === role
        );

        if(found) {
            // Save session
            localStorage.setItem("currentUser", JSON.stringify(found));

            // Redirect based on role
            if(role === "student") {
                window.location.href = "student_dashboard.html";
            } else {
                window.location.href = "admin_dashboard.html";
            }
        } else {
            document.getElementById("error").innerText = 
                "Invalid username, password, or role!";
        }
    }
</script>

</body>
</html>
