<!-- Modal -->
<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="<?= $id ?>"><?= $title ?? 'delete' ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= $content ?>
            </div>
            <div class="modal-footer">
                <a id="clickBtn" type="button" class="btn btn-primary">đồng ý</a>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    không
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    const myModal = document.getElementById('<?= $id ?>')
    const btnDelete = document.getElementById('<?= $btnShowModal ?>')
    myModal.addEventListener('shown.bs.modal', () => {
        myModal.querySelector('#clickBtn').href = btnDelete.dataset.value;
    })
</script>