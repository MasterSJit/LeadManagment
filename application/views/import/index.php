<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Leads</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Import Leads</h1>
        <?php if ($this->session->flashdata('message')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('message'); ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>
        <?php echo form_open_multipart('import/process'); ?>
            <div class="form-group">
                <label for="excel_file">Excel File</label>
                <input type="file" class="form-control-file" id="excel_file" name="excel_file" required>
            </div>
            <button type="submit" class="btn btn-primary">Import Leads</button>
        <?php echo form_close(); ?>
    </div>
</body>
</html>