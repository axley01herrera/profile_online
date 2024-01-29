<div class="card">
    <div class="card-header">
        <h5>Hoy</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4 text-center mt-5">
                <p class="mb-2"><strong>Efectivo:</strong></p>
                <h5 class="text-primary">€ <?php echo number_format($collectionDay['cash'], 2, ".", ','); ?></h5>
            </div>
            <div class="col-4 text-center mt-5">
                <p class="mb-2"><strong>Tarjeta:</strong></p>
                <h5 class="text-primary">€ <?php echo number_format($collectionDay['card'], 2, ".", ','); ?></h5>
            </div>
            <div class="col-4 text-center mt-5">
                <p class="mb-2"><strong>Total:</strong></p>
                <h5 class="text-primary">€ <?php echo number_format($collectionDay['total'], 2, ".", ','); ?></h5>
            </div>
        </div>
    </div>
</div>