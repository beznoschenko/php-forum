<!-- //$them  -->
<!-- <div class="container mb-5">
    <?php //if (isset($_SESSION['auth'])) { 
    ?>
        <form method="POST" class="col-7 mx-auto">
        <div class="row mx-auto">
            <div class="col-auto">
                <label for="title" class="col-form-label">Title</label>
            </div>
            <div class="col-auto">
                <input type="text" name="title" id="title" class="form-control col-md-3">
            </div>
            <div class="col-auto">
                <label for="text" class="col-form-label">Description</label>
            </div>
            <div class="col-auto">
                <input type="text" name="text" id="text" class="form-control col-md-3">
            </div>
            <input type="submit" value="Add" name="addtheme" class="btn btn-primary col-1">
    </div>
        </form>-->

<!-- </div> -->
<br />
<?php if(isset($_SESSION['auth'])){ ?>
<a href="" data-bs-toggle="modal" data-bs-target="#topicModal" class="col-md-auto link-secondary ms-3">Add topic </a>
<?php } ?>

<table class="table" id="topic-list">
    <tr id="table-head">
        <th scope="col" class="col-6">Тема</th>
        <th scope="col">Дата создания</th>
        <th scope="col">Автор</th>
    </tr>
   
</table>




<div class="modal fade" id="topicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new comments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Description:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="send-btn">Send message</button>
            </div>
        </div>
    </div>
</div>