
<form action="wyszukiwarka.php" method = "post" style="float:right">
        <input type="search" name="wyszukiwana" text="Wpisz wyszukiwaną fraze"/>
        
        
        <?php
            require 'database.php';
            $connection = @new mysqli($host, $db_user, $db_password, $db_name);
            $zapytanie = @$connection->query("SELECT * FROM Gatunek");
            echo '<select id="gatun" name="gatun">';
            while($option = $zapytanie->fetch_assoc()) {
                echo '<option value="'.$option['nazwa_gatunek'].'">'.$option['nazwa_gatunek'].'</option>';
            }
            echo '</select>';
        ?>

        <input type="submit" value="Wyszukaj" method="post"/>

        </form>
        