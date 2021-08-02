 <div class="card mx-5 my-3">
  <div class="card-body" id = "topic">

    <p class="card-title">
      <span class="h3" id = "topic-title"></span>
      <small class="card-subtitle ms-2 mb-2 text-muted h6 small" id="topic-props">
      </small>
    </p>
    <p class="card-text" id="topic-text"></p>

    <!-- <a href="" data-bs-toggle= "modal" data-bs-target="#exampleModal" data-bs-whatever=0 class="col-md-auto link-secondary">Add comment </a> -->
  </div>
</div>
<div class="px-5" id ="comments">
  <ul class="list-unstyled" id="list_comments">

  </ul>
</div> 

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new comments</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
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