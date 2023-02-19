<?php
	
	// mulai session
    session_start();

    // hilangkan/unset session member
    // session_destroy();
    unset($_SESSION['member']);

    // hilangkan cookienya
    setcookie("idC", "", time()-3600);
    setcookie("keyC", "", time()-3600);

    // alihkan ke halaman index
    echo "<script>location ='index.php';</script>";
    header("Location: index.php");
    exit();
    
?>