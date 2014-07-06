<?php ///Blood Stain Child ##melodic metal!!!
require_once 'config.php';

/**
 * Login/User Check
 */
//if(isset($_REQUEST[session_name()]))
session_start();

function escape_u ($path) {
    $path = strtoupper ($path);
    return strtr($path, array("#U0430"=>"а", "#U0431"=>"б", "#U0432"=>"в",
        "#U0433"=>"г", "#U0434"=>"д", "#U0435"=>"е", "#U0451"=>"ё", "#U0436"=>"ж", "#U0437"=>"з", "#U0438"=>"и",
        "#U0439"=>"й", "#U043A"=>"к", "#U043B"=>"л", "#U043C"=>"м", "#U043D"=>"н", "#U043E"=>"о", "#U043F"=>"п",
        "#U0440"=>"р", "#U0441"=>"с", "#U0442"=>"т", "#U0443"=>"у", "#U0444"=>"ф", "#U0445"=>"х", "#U0446"=>"ц",
        "#U0447"=>"ч", "#U0448"=>"ш", "#U0449"=>"щ", "#U044A"=>"ъ", "#U044B"=>"ы", "#U044C"=>"ь", "#U044D"=>"э",
        "#U044E"=>"ю", "#U044F"=>"я", "#U0410"=>"А", "#U0411"=>"Б", "#U0412"=>"В", "#U0413"=>"Г", "#U0414"=>"Д",
        "#U0415"=>"Е", "#U0401"=>"Ё", "#U0416"=>"Ж", "#U0417"=>"З", "#U0418"=>"И", "#U0419"=>"Й", "#U041A"=>"К",
        "#U041B"=>"Л", "#U041C"=>"М", "#U041D"=>"Н", "#U041E"=>"О", "#U041F"=>"П", "#U0420"=>"Р", "#U0421"=>"С",
        "#U0422"=>"Т", "#U0423"=>"У", "#U0424"=>"Ф", "#U0425"=>"Х", "#U0426"=>"Ц", "#U0427"=>"Ч", "#U0428"=>"Ш",
        "#U0429"=>"Щ", "#U042A"=>"Ъ", "#U042B"=>"Ы", "#U042C"=>"Ь", "#U042D"=>"Э", "#U042E"=>"Ю", "#U042F"=>"Я"));
}
function descape_u ($path) {
    return strtr($path, array("а"=>"#U0430", "б"=>"#U0431", "в"=>"#U0432",
        "г"=>"#U0433", "д"=>"#U0434", "е"=>"#U0435", "ё"=>"#U0451", "ж"=>"#U0436", "з"=>"#U0437", "и"=>"#U0438",
        "й"=>"#U0439", "к"=>"#U043A", "л"=>"#U043B", "м"=>"#U043C", "н"=>"#U043D", "о"=>"#U043E", "п"=>"#U043F",
        "р"=>"#U0440", "с"=>"#U0441", "т"=>"#U0442", "у"=>"#U0443", "ф"=>"#U0444", "х"=>"#U0445", "ц"=>"#U0446",
        "ч"=>"#U0447", "ш"=>"#U0448", "щ"=>"#U0449", "ъ"=>"#U044A", "ы"=>"#U044B", "ь"=>"#U044C", "э"=>"#U044D",
        "ю"=>"#U044E", "я"=>"#U044F", "А"=>"#U0410", "Б"=>"#U0411", "В"=>"#U0412", "Г"=>"#U0413", "Д"=>"#U0414",
        "Е"=>"#U0415", "Ё"=>"#U0401", "Ж"=>"#U0416", "З"=>"#U0417", "И"=>"#U0418", "Й"=>"#U0419", "К"=>"#U041A",
        "Л"=>"#U041B", "М"=>"#U041C", "Н"=>"#U041D", "О"=>"#U041E", "П"=>"#U041F", "Р"=>"#U0420", "С"=>"#U0421",
        "Т"=>"#U0422", "У"=>"#U0423", "Ф"=>"#U0424", "Х"=>"#U0425", "Ц"=>"#U0426", "Ч"=>"#U0427", "Ш"=>"#U0428",
        "Щ"=>"#U0429", "Ъ"=>"#U042A", "Ы"=>"#U042B", "Ь"=>"#U042C", "Э"=>"#U042D", "Ю"=>"#U042E", "Я"=>"#U042F"));
}

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {

    if (isset($_SESSION['timeout'])) {
        # Check Session Time for expiry
        #
        # Time is in seconds. 10 * 60 = 600s = 10 minutes
        if ($_SESSION['timeout'] + 30 * 60 < time()) {
            session_destroy();
            header("Location: /");
        }
    }

        if (isset($_GET['q'])) {
            $path= pathinfo($_GET['q']);

            if (preg_match('/[а-яА-Я]/', $path['filename'])) {
                $truename= descape_u($path['filename']);
                $tmp= $path['dirname']. '/' .$truename.'.'.$path['extension'];

                include $tmp;
                //var_dump($tmp);
            } else //var_dump('english');
                include $_GET['q'];

            //include 'tpl/userblock.php';

        } else {
        //Default Page

        //$page_class = 'page-docs';
        //$main_block .= 'page/docs/index.html';

            header('Location: /page/docs');
        }

} else {
    # Check for session timeout, else initiliaze time
    # Initialize variables
    $_SESSION['user'] = "";
    $_SESSION['login'] = "";
    $_SESSION['email'] = "";
    $_SESSION['timeout'] = time();

    if (isset($_GET['q'])) {
        header('Location: /');
    } else {
        //include 'login.php';
        $page_class = 'page-login';
        $main_block .= 'page/login/login.php';
        include 'tpl/main.php';
    }
}

?>