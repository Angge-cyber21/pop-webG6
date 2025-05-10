<?php
require_once 'db.php';

if (isset($_GET['restaurant'])) {
    $restaurant = $_GET['restaurant'];

    // Fetch tables for the chosen restaurant
    $stmt = $pdo->prepare("SELECT table_number, is_available FROM restaurant_tables WHERE restaurant_name = ?");
    $stmt->execute([$restaurant]);
    $tables = $stmt->fetchAll();

    // Display tables in an HTML format
    echo "<h2>Table Availability for $restaurant</h2>";

    if (empty($tables)) {
        echo "<p>No tables added to this restaurant yet.</p>";
    } else {
        echo "<table>
                <tr>
                    <th>Table Number</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>";
        foreach ($tables as $table):
            $isAvailable = $table['is_available'];
            $tableNum = $table['table_number'];
            echo "<tr>
                <td>Table $tableNum</td>
                <td class='" . ($isAvailable ? 'available' : 'unavailable') . "'>" . 
                    ($isAvailable ? 'Available ✅' : 'Unavailable ❌') . 
                "</td>
                <td>";
            if (!$isAvailable) {
                echo "<form method='POST' style='margin: 0;'>
                        <input type='hidden' name='restaurant_name' value='" . htmlspecialchars($restaurant) . "'>
                        <input type='hidden' name='table_number' value='$tableNum'>
                        <button type='submit' name='reset_table' class='reset-btn'>Reset</button>
                      </form>";
            } else {
                echo "—";
            }
            echo "</td></tr>";
        endforeach;
        echo "</table>";
    }
}
?>
