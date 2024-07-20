<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f0f2f5;
    color: #333;
}

header {
    background-color: #1a73e8;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

header h1 {
    margin: 0;
    font-size: 1.5rem;
}

#logoutButton {
    background-color: #d32f2f;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#logoutButton:hover {
    background-color: #b71c1c;
}

nav {
    background-color: #2e3b4e;
}

nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
    padding: 1rem 0;
}

nav ul li {
    margin: 0 1rem;
}

nav ul li a {
    color: white;
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

nav ul li a:hover {
    background-color: #3f4c61;
}

main {
    flex: 1;
    padding: 2rem;
    background-color: #f0f2f5;
}

.dashboard {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 2rem;
}

.card {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 1.5rem;
    text-align: center;
    flex: 1 1 calc(25% - 2rem);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.card h2 {
    margin-bottom: 1rem;
    color: #1a73e8;
}

footer {
    background-color: #2e3b4e;
    color: white;
    text-align: center;
    padding: 1rem;
}
</style>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Hub</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Staff Hub</h1>
        <button id="logoutButton"><a href="logout.php">Logout</a></button>
    </header>
    <nav>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Projects</a></li>
            <li><a href="#">Tasks</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Users</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
    </nav>
    <main>
        <section class="dashboard">
            <div class="card">
                <h2>Active Projects</h2>
                <p>10</p>
            </div>
            <div class="card">
                <h2>Completed Tasks</h2>
                <p>150</p>
            </div>
            <div class="card">
                <h2>Pending Tasks</h2>
                <p>25</p>
            </div>
            <div class="card">
                <h2>Team Members</h2>
                <p>5</p>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Staff Hub</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>
