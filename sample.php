<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* style.css */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f8f8;
        }

        .purchase-order {
            width: 80%;
            max-width: 800px;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            font-size: 1.8em;
            margin: 0;
        }

        header p {
            font-size: 1.2em;
            color: #555;
        }

        

        .company-info {
            text-align: right;
            margin: 20px 0;
        }

        .company-info p {
            margin-bottom: 0px;
        }

        .supplier-info {
            margin: 20px 0;
        }

        .creator-info {
            text-align: right;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="purchase-order">
        <header>
            
        </header>

        <section class="company-info">
            <p>Purchase Order - 1009</p>
            <p>Date: January 1, 2024</p>
            <p>Company Name</p>
            <p>Company Address</p>
            <p>Contact No.</p>
        </section>

        <section class="supplier-info">
            <p>Supplier</p>
            <!-- Supplier details go here -->
        </section>

        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Parent Barcode</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sample Description</td>
                    <td>40091231</td>
                    <td>Brand</td>
                    <td>Category</td>
                    <td>90</td>
                </tr>
            </tbody>
        </table>

        <section class="creator-info">
            <p>Requested by: John Jone</p>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
