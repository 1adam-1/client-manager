<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
        }
        .content {
            margin-top: 50px;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
    <div class="container" style="margin-left: 5px; ">
        <div style="background-color: black; color: white; width: 600px; height: 250px;">
            <img src="https://airlod.com/wp-content/uploads/2023/08/cropped-LOGO-Airlod-blanc-copie-1.png" alt="" style="height: 2.5em; width: 10em; margin-top: 25px;">
            <div style="display: flex; margin-top: 20px;">
                <div>
                    <h3 style="margin-left: 10px;">Airlod Sarl</h3>
                    <p style="margin-left: 10px;">
                        N21 Res. Tachfine Av. Yacoub Lamrani<br>
                        Gueliz 40 000 Marrakech <br>
                        Numéro de téléphone : 06 40 00 88 82 <br>
                        Email : Contact@airlod.com
                    </p>
                </div>
                <div style="margin-left: 95px;">
                    <p>Date:<input type="text" class="form-control d-inline" style="width: 200px;background-color:black;color:white;border:none;"></p>
                    <p>Numéro de facture n°: <input type="text" class="form-control d-inline" style="width: 200px;background-color:black;color:white;border:none;"></p>
                    <p>Ticket n°: <input type="text" class="form-control d-inline" style="width: 200px;background-color:black;color:white;border:none;"></p>
                </div>
            </div>
        </div>
        <div class="content">
            <h2>Details</h2>
            <table class="table table-bordered" style="width: 600px;">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Prix unitaire</th>
                        <th>Total HT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control d-inline" style="width: 300px;border:none;"></td>
                        <td><input type="text" class="form-control d-inline" style="width: 100px;border:none;"></td>
                        <td><input type="text" class="form-control d-inline" style="width: 100px;border:none;"></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped-columns" style="width: 400px; margin-left: 150px;">
                <tr>
                    <th>Montant total HT</th>
                    <td><input type="text" class="form-control d-inline" style="width: 200px;"></td>
                </tr>
                <tr>
                    <th>Remise</th>
                    <td><input type="text" class="form-control d-inline" style="width: 200px;"></td>
                </tr>
                <tr>
                    <th>Total net HT</th>
                    <td><input type="text" class="form-control d-inline" style="width: 200px;"></td>
                </tr>
                <tr>
                    <th>Total TVA</th>
                    <td><input type="text" class="form-control d-inline" style="width: 200px;"></td>
                </tr>
                <tr>
                    <th>Montant total TTC</th>
                    <td><input type="text" class="form-control d-inline" style="width: 200px;"></td>
                </tr>
            </table>
        </div>
        <button id="downloadBtn" class="btn btn-outline-dark">Download Invoice</button>
    </div>
    <script>
        document.getElementById('downloadBtn').addEventListener('click', function () {
            html2canvas(document.body).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF();
                pdf.addImage(imgData, 'PNG', 4, 4);
                pdf.save("invoice.pdf");
            });
        });
    </script>
</body>
</html>
