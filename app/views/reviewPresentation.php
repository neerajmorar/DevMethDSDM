<?php
require '../public/_elements.php';

$pageTitle = 'Review Presentation';
require '../public/_header.php';
?>
</header>

<div id="content">
    <h2><?php echo $pageTitle; ?></h2>
    
    <form method="post">
        <div class="table-layout">
            <div class="left-col"></div>
            <div class="right-col">
                <div class="row-1">
                    <iframe src="http://docs.google.com/gview?url=http://52.30.7.198/public/presentation<?php echo $data; ?>&embedded=true" style="width:100%; height:700px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </form>
</div>

</body>
</html>