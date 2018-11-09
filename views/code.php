<?php include 'header.php'; ?>

<div class="row vh">
    <div class="col d-flex justify-content-center align-items-center flex-column">
        <h1 class="text-center">КОД КЛИЕНТА</h1>        
        <div class="block-inputs-green text-center pt-4 pb-4 pr-xs-4 pl-xs-4">
            <form method="post" class="d-flex" id="client-code">
                <div class="form-check form-check-inline ml-3">
                    <input class="form-check-input code" data-count="1" name="code[]" type="number" min="0" max="9">
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input code" data-count="2" name="code[]" type="number" min="0" max="9" disabled="true">
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input code" data-count="3" name="code[]" type="number" min="0" max="9" disabled="true">
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input code" data-count="4" name="code[]" type="number" min="0" max="9" disabled="true">
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input code" data-count="5" name="code[]" type="number" min="0" max="9" disabled="true">
                </div>
            </form>            
        </div>
        <span class="mt-4 text-center font-weight-light">Для получения просчета вы должны быть зарегистрированы в мобильном приложении.</span>
    </div>
</div>

<?php include 'footer.php'; ?>
