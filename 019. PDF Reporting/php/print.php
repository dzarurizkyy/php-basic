<?php
  // Import File
  require "model.php";
  require_once __DIR__ . '../../vendor/autoload.php';

  // Variable
  $index_column = 0;
  $index_row    = 1;

  // Initalize MPDF
  $mpdf = new \Mpdf\Mpdf();

  // Table Data
  {
    // Column Title
    {
      $body = '
        <!DOCTYPE html>
        <html>
          <head>
            <title>PHP Basic</title>
            <link rel="icon" type="image/x-icon" href="../../php-logo.svg" />
            <link type="text/css" rel="stylesheet" href="../css/index.css?ver=1.0.1" />
          </head>
          <body class="print-box">
            <div class="print-title">Student Data</div>
            <table border="1" cellspacing="0" cellpadding="10">
              <tr>
                <th class="">No</th>
                <th class="print-table-data">Image</th>';
                foreach($columns as $column) :
                  $body .= "<th class='print-table-data'>" . 
                              ($index_column !==  1 ? ucfirst($column) : strtoupper($column)) . 
                            "</th>";    
                  $index_column++; 
                endforeach;
      $body .= '</tr>';

    }
    // Column Data
    {
      foreach($students as $student) : 
        $body .= '<tr>';
        $body .= '<td class="print-table-data-no">' . $index_row . '</td>';
        $body .= '<td class="print-table-data">'. '<img src="../img/'. $student["name"] . '.jpg" width="60" />' .'</td>';
        foreach($columns as $column) :
          $body .= '<td class="print-table-data">' . $student[$column] . '</td>';
        endforeach;
        $body .= '</tr>';
        $index_row++;
      endforeach;
    }
    // Close
    {
      $body .= '        
            </table>
          </body>
        </html>';
    }
  }

  // Convert to PDF
  $mpdf->WriteHTML($body);
  $mpdf->Output("student-data.pdf", "I");
?>