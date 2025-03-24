<?php
echo "<h3>Părerile clienților noștri</h3>";

if (file_exists('date.txt')) {
    $lines = file('date.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    echo "<style>
            h3 {
                text-align: center;
                color: #333;
                font-size: 1.5em;
                margin: 30px 0 20px;
            }
            .feedback-container {
                width: 350px;
                margin: 0 auto;
            }
            .feedback-entry:nth-child(odd) {
                background-color: #ffd700;
            }
            .feedback-entry:nth-child(even) {
                background-color: #ffe4e1;
            }
            .feedback-entry {
                padding: 15px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 1.1em;
                color: #333;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .feedback-entry:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
          </style>";

    echo "<div class='feedback-container'>";
    foreach ($lines as $line) {
        echo "<div class='feedback-entry'>$line</div>";
    }
    echo "</div>";
} else {
    echo "<div style='text-align: center; color: #555;'>Nu există păreri momentan.</div>";
}
?>