<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice Template</title>
    <style>
        body {
            padding: 30px 15px !important;
            margin: 0;
            font-family: Arial, sans-serif;
            /* Example: Change font family */
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            overflow: hidden;
            /* Clearfix */
        }

        .left-side {
            float: left;
            width: 48%;
        }

        .right-side {
            float: right;
            width: 48%;
            /* Adjust as needed */
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .right-side .header {
            margin-top: 60px;
        }

        .header img {
            max-width: 250px;
            height: auto;
        }

        .header h1 {
            font-size: 2.8rem;
            margin: 0;
            color: #37bfec;
            padding: 10px;
            /* Padding for better visual appearance */
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-top: 80px;
        }

        th,
        td {
            text-align: left;
            padding: 20px;
            /* Increased padding for cells */

        }

        th {
            background-color: #37bfec;
            /* Background color for table headings */
        }

        .text-align-right {
            text-align: right;
        }

        .text-align-left {
            text-align: left;
        }

        .align-container {
            display: table;
            width: 100%;
        }

        .align-left,
        .align-right {
            display: table-cell;
            vertical-align: middle;
        }

        .align-left {
            text-align: left;
        }

        .align-right {
            text-align: right;
            font-size: 1.5em;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-side">
            <div class="header">
                <img src="http://localhost:8000/assets/images/logo.png" alt="Logo">
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Supplier:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Supplier Name</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Customer:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Customer Name</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="right-side">
            <div class="header">
                <h1>Billing Invoice</h1>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>INVOICE NO.</th>
                            <th class="text-align-right">DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>7029</td>
                            <td class="text-align-right">7029</td>

                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th> Supplier ID </th>
                            <th class="text-align-right">PAYOUT CYCLEL</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>7029</td>
                            <td class="text-align-right">7029</td>

                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
        <div style="clear: both;"></div> <!-- Clear floats -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th> DESCRIPTION </th>
                        <th class="text-align-right">Generated Revenue</th>
                        <th class="text-align-right">Percentage</th>
                        <th class="text-align-right">AMOUNT</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Revenue Generated</td>
                        <td class="text-align-right">2,661.93</td>
                        <td class="text-align-right">40%</td>
                        <td class="text-align-right">1,072.77</td>


                    </tr>
                    <tr>
                        <td>Revenue Generated</td>
                        <td class="text-align-right">2,661.93</td>
                        <td class="text-align-right">40%</td>
                        <td class="text-align-right">1,072.77</td>


                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>
                            <div class="align-container">
                                <div class="align-left">
                                    <h2 style="margin: 0;">Thank you for your business</h2>
                                </div>
                                <div class="align-right">
                                    Total USD
                                </div>
                            </div>
                        </th>
                        <th class="text-align-right" style="width: 45%; background-color: #81d7f3;">1,650,23</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div style="
        margin: 0 auto;
        width: 50%;
        text-align: center;
        line-height: 1.7;
        margin-top: 5rem;
    ">
                <p>if you have any Question  about this invoice please contact <b>Voov Media</b>, <a href="">+1 (305) 857-5147</a> ,<b>Billing@voovmedia.com</b></p>
            </div>
    </div>
</body>

</html>