<?php
require '../public/_elements.php';

$pageTitle = 'Home';
require '../public/_header.php';
?>
</header>

<div id="content">
    <h2><?php echo $pageTitle; ?></h2>
    
    <form method="post">
        <div class="table-layout">
            <div class="left-col">
                <div class="row-1">
                    <input class="homePage" type="button" value="Create Event" onclick="location.href='index.php?url=home/createEvent'" />
                </div>
                <div class="row-2">
                    <input class="homePage" type="button" value="Invite Contributors" onclick="location.href='index.php?url=home/inviteContributors'" />
                </div>
                <div class="row-3">
                    <input class="homePage" type="button" value="Submit Abstract" onclick="location.href='index.php?url=home/submitAbstract'" />
                </div>
            </div>
            <div class="table-space"></div>
            <div class="right-col">
                <div class="row-1">
                    <input class="homePage" type="button" value="Manage Event" onclick="location.href='index.php?url=home/manageEvent'" />
                </div>
                <div class="row-2">
                    <input class="homePage" type="button" value="Invite Audience" onclick="location.href='index.php?url=home/inviteAudience'" />
                </div>
                <div class="row-3">
                    <input class="homePage" type="button" value="Submit Presentation" onclick="location.href='index.php?url=home/submitPresentation'" />
                </div>
            </div>
        </div>
    </form>
</div>

</body>
</html>

