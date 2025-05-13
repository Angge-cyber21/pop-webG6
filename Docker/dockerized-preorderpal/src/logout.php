<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logging out...</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
    Swal.fire({
        icon: 'info',
        title: 'Logged Out',
        text: 'You have been logged out successfully.',
        timer: 2000,
        showConfirmButton: false
    }).then(() => {
        window.location.href = 'login.php';
    });
</script>
</body>
</html>
