<?php
session_start();
if (isset($_SESSION["UserName"])) {
    header("location:index.php");
    exit();
}
include('includes/connect.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $stmt = $conn->prepare("SELECT * FROM usermaster WHERE UserName=? AND UserType=?");
    $stmt->bind_param(
        "ss", $_POST["UserName"],
        $_POST["UserType"]
    );
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && mysqli_num_rows($result) > 0) {
        $User_data = mysqli_fetch_assoc($result);
        if (password_verify($_POST["Password"], $User_data['Password'])) {
            session_regenerate_id(true);
            $_SESSION['UserName'] = $User_data['UserName'];
            $_SESSION['UserType'] = $User_data['UserType'];
            $_SESSION['DeptID'] = $User_data['DeptID'];
            $_SESSION['UserMasterID'] = $User_data['UserMasterID'];
            header("location:index.php");
            exit();
        } else {
            echo "<script>alert('Please enter correct login credentials.')</script>";
        }
    } else {
        echo "<script>alert('Please enter correct login credentials.')</script>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Login | Leave Management</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "outline-variant": "#c3c6d7",
                        "secondary-fixed-dim": "#b9c7df",
                        "on-tertiary-fixed-variant": "#7d2d00",
                        "on-tertiary-fixed": "#360f00",
                        "primary-fixed": "#dbe1ff",
                        "primary-fixed-dim": "#b4c5ff",
                        "tertiary-container": "#bc4800",
                        "surface-dim": "#d8dadc",
                        "background": "#f7f9fb",
                        "surface-variant": "#e0e3e5",
                        "surface-container": "#eceef0",
                        "outline": "#737686",
                        "on-error": "#ffffff",
                        "inverse-primary": "#b4c5ff",
                        "inverse-on-surface": "#eff1f3",
                        "tertiary-fixed": "#ffdbcd",
                        "on-secondary-fixed": "#0d1c2e",
                        "on-primary-container": "#eeefff",
                        "secondary-fixed": "#d5e3fc",
                        "surface-container-lowest": "#ffffff",
                        "secondary": "#515f74",
                        "on-error-container": "#93000a",
                        "error": "#ba1a1a",
                        "on-primary-fixed-variant": "#003ea8",
                        "tertiary": "#943700",
                        "tertiary-fixed-dim": "#ffb596",
                        "secondary-container": "#d5e3fc",
                        "error-container": "#ffdad6",
                        "surface-container-highest": "#e0e3e5",
                        "surface-bright": "#f7f9fb",
                        "on-secondary": "#ffffff",
                        "on-primary-fixed": "#00174b",
                        "surface": "#f7f9fb",
                        "primary-container": "#2563eb",
                        "on-background": "#191c1e",
                        "on-tertiary-container": "#ffede6",
                        "surface-container-low": "#f2f4f6",
                        "on-primary": "#ffffff",
                        "inverse-surface": "#2d3133",
                        "surface-container-high": "#e6e8ea",
                        "on-tertiary": "#ffffff",
                        "on-surface-variant": "#434655",
                        "primary": "#004ac6",
                        "on-secondary-container": "#57657a",
                        "surface-tint": "#0053db",
                        "on-surface": "#191c1e",
                        "on-secondary-fixed-variant": "#3a485b"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "1rem",
                        "xl": "1.25rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Inter", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                        "label": ["Inter", "sans-serif"]
                    }
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
        .editorial-shadow {
            box-shadow: 0 20px 40px rgba(0, 74, 198, 0.06);
        }
        .brand-gradient {
            background: linear-gradient(135deg, #004ac6 0%, #2563eb 100%);
        }
        .ghost-border {
            border: 1px solid rgba(195, 198, 215, 0.15);
        }
    </style>
</head>
<body class="bg-gradient-primary bg-surface font-body text-on-surface min-h-screen flex flex-col">
<!-- Main Content Canvas -->
<main class="flex-grow flex items-center justify-center px-4 pt-20 pb-12 relative overflow-hidden">
<!-- Aesthetic Background Accents -->
<div class="absolute top-[-10%] left-[-5%] w-[40%] h-[60%] rounded-full bg-primary/5 blur-[120px]"></div>
<div class="absolute bottom-[-10%] right-[-5%] w-[30%] h-[50%] rounded-full bg-primary-container/10 blur-[100px]"></div>
<div class="w-full max-w-[480px] z-10">
<!-- Login Card -->
<div class="bg-surface-container-lowest editorial-shadow rounded-lg p-10 relative overflow-hidden">
<!-- Brand Stripe (Institutional Curator Aesthetic) -->
<div class="absolute left-0 top-0 bottom-0 w-1.5 brand-gradient"></div>
<div class="mb-10">
<h1 class="text-3xl font-extrabold text-on-surface tracking-tight leading-tight">Welcome Back</h1>
<p class="text-secondary mt-3 text-sm leading-relaxed"> Please enter your credentials to continue to your dashboard.</p>
</div>
<form class="space-y-6" method="POST">
<!-- User Type Dropdown -->
<div class="space-y-2">
<label class="block text-xs font-bold tracking-widest text-secondary uppercase ml-1">User Type</label>
<div class="relative">
<select class="w-full h-12 px-4 bg-surface-container-low border-none rounded-lg text-on-surface text-sm focus:ring-2 focus:ring-primary/20 transition-all appearance-none" name="UserType" id="UserType" required="">
     <option value="">User Type</option>
     <option>Admin</option>
     <option>ESTA</option>
     <option>Department User</option>
</select>
<div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-primary">
<span class="material-symbols-outlined">expand_more</span>
</div>
</div>
</div>
<!-- Name Input -->
<div class="space-y-2">
<label class="block text-xs font-bold tracking-widest text-secondary uppercase ml-1">Enter Name</label>
<div class="relative group">
<div class="absolute left-4 top-1/2 -translate-y-1/2 text-primary/60 group-focus-within:text-primary transition-colors">
<span class="material-symbols-outlined text-[20px]">person</span>
</div>
<input type="Text" name="UserName" class="w-full h-12 pl-12 pr-4 bg-surface-container-low border-none rounded-lg text-on-surface text-sm focus:ring-2 focus:ring-primary/20 transition-all hover:bg-surface-container-high placeholder:text-outline/60" placeholder="Enter User name" required/>
</div>
</div>
<!-- Password Input -->
<div class="space-y-2">
<div class="flex justify-between items-center ml-1">
<label class="block text-xs font-bold tracking-widest text-secondary uppercase">Password</label>
</div>
<div class="relative group">
<div class="absolute left-4 top-1/2 -translate-y-1/2 text-primary/60 group-focus-within:text-primary transition-colors">
<span class="material-symbols-outlined text-[20px]">lock</span>
</div>
<input type="password" name="Password" class="w-full h-12 pl-12 pr-4 bg-surface-container-low border-none rounded-lg text-on-surface text-sm focus:ring-2 focus:ring-primary/20 transition-all hover:bg-surface-container-high placeholder:text-outline/60" placeholder="••••••••" required/>
</div>
</div>
<!-- Login Button -->
<div class="pt-4">
<button name="login" class="w-full h-12 brand-gradient text-white font-bold rounded-lg shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2 group" type="submit">
<span class="text-sm">Login</span>
<span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
</button>
</div>
</form>
</div>
</div>
</main>
</body>
</html>