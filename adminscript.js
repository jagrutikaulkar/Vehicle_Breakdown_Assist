
	function openAdminProfile() {
		// Redirect to admin profile page
		window.location.href = 'admin_profile.php';
	}

    function logout() {
        // Redirect to admin login page
        window.location.href = 'adminlogin.html';
        // Replace the current history entry with the admin login page
        window.history.replaceState({}, document.title, 'adminlogin.html');
    }

	function dashboard()
	{
		window.location.href = 'admindashboard.php';
	}

    function mech_list()
    {
        window.location.href = 'admin_mech_list.php';
    }
    function cust_list()
    {
        window.location.href = 'admin_cust_list.php';
    }

    function admin_setting()
    {
        window.location.href = 'adminsetting.php';

    }

    function toggleMenu() {
        var nav = document.querySelector(".navcontainer");
        nav.classList.toggle("navclose");
    }