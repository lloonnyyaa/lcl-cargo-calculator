<?php include 'header.php'; ?>

<div class="row vh">
    <div class="col p-4">
        <form method="post" class="height-100 d-flex flex-column flex-fill">
            <div class="form-group row calc-field">
                <label for="condition" class="col-6 col-form-label text-center d-flex flex-column justify-content-center">Условия доставки</label>
                <div class="col-6">
                    <select name="calc[condition]" id="condition" class="form-control" required="required">
                        <!--option value="" disabled selected>+</option-->
                        <option value="fob" selected>FOB</option>
                    </select>
                </div>
            </div>
            <div class="form-group row calc-field">
                <label for="country" class="col-6 col-form-label text-center d-flex flex-column justify-content-center">Страна</label>
                <div class="col-6">
                    <select name="calc[country]" id="country" class="form-control" required="required">
                        <option  value="" disabled selected>+</option>
                        <?php foreach ($countries as $country): ?>                        
                            <option value="<?php echo $country ?>"><?php echo $country ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row calc-field">
                <label for="port" class="col-6 col-form-label text-center d-flex flex-column justify-content-center">Порт погрузки</label>
                <div class="col-6">
                    <select name="calc[port]" id="port" class="form-control" required="required">
                        <option  value="" disabled selected>+</option>
                        <?php foreach ($ports as $port): ?>                        
                            <option value="<?php echo $port ?>"><?php echo $port ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row calc-field">
                <label for="city" class="col-6 col-form-label text-center d-flex flex-column justify-content-center">Место доставки</label>
                <div class="col-6">
                    <select name="calc[city]" id="city" class="form-control" required="required">
                        <option  value="" disabled selected>+</option>
                        <?php foreach ($cities as $city): ?>                        
                            <option value="<?php echo $city ?>"><?php echo $city ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row calc-field">
                <label for="weight" class="col-6 col-form-label text-center d-flex flex-column justify-content-center">Вес в кг</label>
                <div class="col-6">
                    <input name="calc[weight]" id="weight" type="text" placeholder="_  _  _" required="required">
                </div>
            </div>
            <div class="form-group row calc-field">
                <label for="volume" class="col-6 col-form-label text-center d-flex flex-column justify-content-center">Обьем в м3</label>
                <div class="col-6">
                    <input name="calc[volume]" id="volume" type="text" placeholder="_  _  _" required="required">
                </div>
            </div>
            <div class="form-group row calc-field">
                <button type="submit" name="submit_calc" class="btn btn-block calc-button pt-3 pb-3">РАССЧИТАТЬ</button>
            </div>
        </form>
        <!--div class="form-group row calc-field">
            <button class="btn btn-block history-button pt-1 pb-1">ИСТОРИЯ</button>
        </div-->
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <p class="text-center">Расчет отправлен в раздел "Сообщения" в приложении "Твоя логистика"</p>
                <img class="img-fluid" src="views/img/TL.png" alt="">
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn button-modal-close btn-lg pr-5 pl-5 pt-3 pb-3" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<?php if ($form_submit): ?>
    <script>
        jQuery('#exampleModalCenter').modal('show');
    </script>
<?php endif ?>

<?php include 'footer.php'; ?>