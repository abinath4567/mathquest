<!DOCTYPE html>

<html>

<head>
    <title>MathQuest Login</title>

<style>
    body {
        font-family: Arial;
        background: linear-gradient(to right, rgb(52,152,219), rgb(155,89,182));
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-box {
        background: white;
        width: 320px;
        padding: 25px;
        border-radius: 12px;
        text-align: center;
    }

    input {
        width: 90%;
        padding: 10px;
        margin: 10px 0;
    }

    button {
        background-color: rgb(52,152,219);
        color: white;
        padding: 10px;
        width: 95%;
        border: none;
        cursor: pointer;
    }
</style>


</head>

<body>

<div class="login-box">
    <h2>MathQuest Login</h2>

```
<input type="text" placeholder="Username">
<input type="password" placeholder="Password">

<button onclick="login()">Login</button>
```

</div>

<script>
    function login() {
        // No checking, just go to dashboard
        window.location.href = "student_dashboard.html";
    }
</script>

</body>
</html>

