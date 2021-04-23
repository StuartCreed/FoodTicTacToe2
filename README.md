<h1>Setup Instructions For Your Local Machine</h1>

<h2>Requirements:</h3>
Ensure that you have the following installed on your machine:
<ul>
    <li>Docker Desktop <a>https://www.docker.com/get-started</a></li>
    <li>npm and node.js <a>https://nodejs.org/en/</a></li>
    <li>Composer <a>https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx</a></li>
</ul>

Note: I have committed the .env file for ease as there is no sensitive details.

<h2>Steps</h2>
<ol>
    <li>run: <span style="color:green">./vendor/bin/sail up<span></span></li><br>
    Notes: This may take a while to download on first time load, as the Docker images are not yet cached.<br><br>
    If any errors occur associated with ports already in use, run the following to remove the containers that have already been made: 
    <span style="color:green">./vendor/bin/sail down</span>
    If the App Port is in use and you can either stop what is currently running on that port or you can run it on a different port instead: <br>
    <span style="color:green">APP_PORT=89 sail up</span><br>
    If the same issue occurs with the database port (3306), you can run this for example to change the port:<br>
    <span style="color:green">FORWARD_DB_PORT=3307 sail up</span><br>
    <li>Connect to the database to ensure that the connection is ok e.g. with TablePlus or however you normally connect.<br>
    The setup details to MySQL will be:<br>
    Host: 127.0.0.1, <br>Port: 3306 (Unless you have used FORWARD_DB_PORT above),<br>
    user: root<br><b>database: foodtictactoe</b><br>
    You will get a permission error when first trying to login, proceed to the next step to correct this.
    </li>
    <li>
    Note: You will need to provide the database permissions manually to avoid errors like when you access
        the database from a MySQL helper like tablePlus or the app itself:<br>
        <p>Host 'IP ADDRESS' is not allowed to connect to this MySQL server/p><br>
        When this happens open the docker docker. Expand the green app arrow, go to the 'foodtictactoe_mysql_1' 
        and click on 'CLI'. Type in <span style="color:green">mysql</span> into the terminal, then enter the (following 
        replacing the following with the ip error that occurs)
        <p><span style="color:green">CREATE USER 'root'@'172.29.0.1' IDENTIFIED BY '';</span></p>
        <p><span style="color:green">GRANT ALL PRIVILEGES ON *.* TO 'root'@'172.29.0.1';</span></p>
        <p><span style="color:green">CREATE USER 'sail'@'172.29.0.7' IDENTIFIED BY '';</span></p>
        <p><span style="color:green">GRANT ALL PRIVILEGES ON *.* TO 'sail'@'172.29.0.7;</span></p>
        Read more here: <a>https://stackoverflow.com/questions/19101243/error-1130-hy000-host-is-not-allowed-to-connect-to-this-mysql-server</a>
    </li>
    <li>Run: <span style="color:green">composer install<span></li>
    <li>Run: <span style="color:green">npm install<span></li>
    <li>Run: <span style="color:green">./vendor/bin/sail artisan migrate<span></li>
    <li>Run: <span style="color:green">./vendor/bin/sail artisan db:seed GameSeeder<span></li>
    <li>Run: <span style="color:green">npm run watch<span></li>
</ol>

Enjoy Food Tic Tac Toe!

Other notes:
<p>QuaserJS Vue3 support is in Beta so I left it out for now. Only major Vue 2 support at the moment. But I look forward to using it in the future.</p>
