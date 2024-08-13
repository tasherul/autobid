<form action="<?= current_url() ?>" method="post">
    <input type="hidden" name="auction_id" value="<?= isset($auction_id) ? $auction_id : 0 ?>" id="auction_id">
    <div class="row">
        <div class="col-md-12">
            <h3>Add Auction</h3>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Car</label>
                <select name="car_id" id="car_id" class="form-control" required>
                    <?php
                    foreach ($posts as $post) {
                        $selected = isset($auction) && $auction->car_id == $post->id ? 'selected' : '';
                    ?>
                        <option value="<?= $post->id ?>" price="<?= $post->price ?>" <?= $selected ?>><?= get_post_data_by_lang($post, 'title') ?></option>
                    <?php }  ?>
                </select>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#car_id').change();
            });
            $('#car_id').change(function(e) {
                e.preventDefault();
                var price = $('#car_id').find(":selected").attr('price');
                $('#min_bid').attr('min', Number(price));
                // $('#min_bid').attr('value', Number(price));
            });
        </script>
        <?php if ($user_type == 1) : ?>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Asking Bid</label>
                    <input type="text" class="form-control" min="1" name="asking_bid" id="asking_bid" value="<?= isset($auction) ? $auction->asking_bid : 0 ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Min Bid</label>
                    <input type="number" class="form-control" min="1" name="min_bid" id="min_bid" value="<?= isset($auction) ? $auction->min_bid : 0 ?>" required>
                </div>
            </div>
        <?php else : ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Min Bid</label>
                    <input type="number" class="form-control" min="1" name="asking_bid" id="asking_bid" value="<?= isset($auction) ? $auction->asking_bid : 0 ?>" required>
                </div>
            </div>
        <?php endif ?>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Start Time</label>
                <input type="datetime-local" class="form-control" name="start_time" id="start_time" value="<?= isset($auction) ? $auction->start_time : 0 ?>" placeholder="Start date and time" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">End Time</label>
                <input type="datetime-local" class="form-control" name="end_time" id="end_time" placeholder="End date and time" value="<?= isset($auction) ? $auction->end_time : 0 ?>" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="float: right;margin-top: 15px;">Submit</button>
            </div>
        </div>
    </div>

</form>