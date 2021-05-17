
<html>
<head>
    <meta charset="utf-8">
    <title>Slip gaji <?=$this->session->userdata('nama')?></title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        text-align:center;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
        text-align:center;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;

    }
    
    .invoice-box table tr.total {
        border-top: 2px solid #eee;
        font-weight: bold;

    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?php echo base_url('assets/img/'.$web->logo) ?>" style="width:100px;">
                            </td>
                            
                            <td>
                                Date :  <?=$this->M_data->hari(date('D')).', '.$this->M_data->tgl_indo(date('Y-m-d'));?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="5">
                    <table>
                        <tr>
                            <td>
                                <font style="font-size: 20px; font-weight: bold"><?=ucwords($web->nama)?></font><br>
                                <?=$web->alamat?><br>
                                <?=$web->nohp?> - <?=$web->email?>
                            </td>
                            
                            <td>
                                <?=ucwords($data->nama)?><br>
                                <?=$data->email?><br>
                                Departemen <?=ucwords($data->departemen)?><br>
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr>
                <th style="width:50%">Jumlah Kehadiran :</th>
                <td><?=$absen?> hari x  Rp. <?=number_format($data->gaji)?></td>
            </tr>
              <tr>
                <th>Jumlah Cuti :</th>
                <td><?=$cuti?> hari x Rp. <?=number_format($data->gaji)?></td>
            </tr>
            <tr>
                <th>Jumlah Sakit :</th>
                <td><?=$sakit?> hari x Rp. <?=number_format($data->gaji)?></td>
            </tr>
            <tr>
                <th>Jumlah Izin Tidak Masuk :</th>
                <td><?=$izin?> hari x Rp. <?=number_format(0)?></td>
            </tr>
            <tr>
                <th>Total Pendapatan :</th>
                <td>Rp. <?=number_format(($absen * $data->gaji) + ($cuti * $data->gaji) + ($sakit * $data->gaji))?></td>
            </tr>
        </table>
        <br><br><br>
        <small>
        <strong>Note : </strong><br>
        Slip gaji ini digenerate otomatis oleh sistem berdasarkan jumlah kehadiran dan jumlah cuti yang dilakukan setiap bulannya</small>
    </div>
</body>
</html>
<script type="text/javascript">
    function PrintWindow() {                    
       window.print();            
       CheckWindowState();
    }

    function CheckWindowState()    {           
        if(document.readyState=="complete") {
            window.close(); 
        } else {           
            setTimeout("CheckWindowState()", 1000)
        }
    }
    PrintWindow();
</script>