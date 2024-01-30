<div class="table-responsive">
    <div class="card mb-5 mt-2">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dt-customer" class="table dataTables_wrapper dt-bootstrap4 no-footer" style="width: 100%;">
                    <thead>
                        <th><strong>Nombre</strong></th>
                        <th><strong>Apellidos</strong></th>
                        <th><strong>Correo Electrónico</strong></th>
                        <th><strong>Teléfono</strong></th>
                        <th class="text-center"><strong>Correo Verificado</strong></th>
                        <th><strong>Inactivo / Activo</strong></th>
                        <th class="text-center"><strong>Acciones</strong></th>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer) : ?>
                            <tr>
                                <td><?php echo $customer->name; ?></td>
                                <td><?php echo $customer->lastName; ?></td>
                                <td><?php echo $customer->email; ?></td>
                                <td><?php if(!empty($customer->phone)) echo $customer->phone; ?></td>
                                <td class="text-center">
                                    <?php if (!empty($customer->emailVerified)) : ?>
                                        <i class="flaticon2-checkmark text-success"></i>
                                    <?php else : ?>
                                        <i class="flaticon2-cancel text-danger"></i>
                                    <?php endif ?>
                                </td>
                                <td class="text-center">
                                    <div class="text-center">
                                        <span class="switch switch-outline switch-icon switch-primary">
                                            <label>
                                                <input class="cbx-customerStatus" type="checkbox" <?php if ($customer->status == 1) echo "checked"; ?> data-id="<?php echo $customer->id; ?>" data-status="<?php echo $customer->status; ?>" />
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button class="btn-edit btn btn-sm btn-warning" data-customer-id="<?php echo $customer->id; ?>">Editar</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    var dtCustomers = new DataTable('#dt-customer', {
        responsive: true,
        bAutoWidth: true,
        pageLength: 10,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'Todos']
        ],
        language: {
            url: '<?php echo base_url('public/assetsv2/datatable/es.json'); ?>'
        },
    });

    dtCustomers.on('click', '.cbx-customerStatus', function() {
        let id = $(this).attr('data-id');
        let status = $(this).attr('data-status');
        let newStatus = '';
        let msg = '';
        if (status == 0) {
            newStatus = 1;
            msg = "Cliente activado";
        } else {
            newStatus = 0;
            msg = "Cliente desactivado";
        }

        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/updateCustomerStatus'); ?>",
            data: {
                'id': id,
                'status': newStatus
            },
            dataType: "json",
            success: function(response) {
                switch (response.error) {
                    case 0:
                        showAlert('success', 'Perfecto', msg);
                        getCustomerDT();
                        break
                    case 1:
                        showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
                        break
                }
            },
            error: function(error) {
                showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
            }
        });
    })

    dtCustomers.on('click', '.btn-edit', function() {
        let customerID = $(this).attr('data-customer-id');
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Customer/editProfile'); ?>",
            data: {
                'customerID': customerID,
                'admin': 1
            },
            dataType: "html",
            success: function(response) {
                $('#main-modal').html(response);
            },
            error: function(error) {
                showAlert('error', 'Lo Sentimos', 'Ha ocurrido un error');
            }
        });

    });
</script>