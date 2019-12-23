<?php
  require_once("./phpQuery-onefile.php");

  // データーベースに接続
  try {
    $db = new PDO('mysql:dbname=mounten;port=8889;host=127.0.0.1;charset=utf8','root','root');
  } catch (PDOException $e) {
    echo 'DB接続エラー: ' . $e->getMessage();
  }

  $db->exec("TRUNCATE table serch_result_handlebars");

  // チェーン・リアクションMTBハンドルバーの検索結果
  $html = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%83%8F%E3%83%B3%E3%83%89%E3%83%AB%E3%83%90%E3%83%BC?f=2258");

  // 検索結果の最大ページ数をカウント
  $pagination = count(phpQuery::newDocument($html)->find("div")->find(".pagination")->find("a"));

  // 検索結果のアイテム数をカウント
  $b = count(phpQuery::newDocument($html)->find("div")->find(".products_details_container"));

  for($i=0;$i<$b;$i++){
      $n[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".description")->find("a")->text();
      $price[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".fromamt")->text();
      $image[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('img')->attr('src');
      $link[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('a')->attr('href');
  }

  // データーベースにインサート
  foreach (array_map(null, $n, $price,$image,$link) as [$a, $b, $c, $d]){
    $a = str_replace(array("\r\n","\r","\n"), '', $a);
    $b = str_replace(array("\r\n","\r","\n"), '', $b);
    $c = str_replace(array("\r\n","\r","\n"), '', $c);
    $d = str_replace(array("\r\n","\r","\n"), '', $d);
    $hoge ="INSERT INTO serch_result_handlebars (name, price, image_url, click_url, site_name) VALUES ('"."$a"."', '"."$b"."', '"."$c"."', '"."$d"."', 'chainReactionCycles')";
    $db->exec($hoge);
  }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ページをめくりデータを抽出
  for($j=2;$j<=$pagination;$j++){
    $html = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%83%8F%E3%83%B3%E3%83%89%E3%83%AB%E3%83%90%E3%83%BC?f=2258&page=$j");

    // 検索結果のアイテム数をカウント
    $b = count(phpQuery::newDocument($html)->find("div")->find(".products_details_container"));

    for($i=0;$i<$b;$i++){
        $n[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".description")->find("a")->text();
        $price[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".fromamt")->text();
        $image[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('img')->attr('src');
        $link[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('a')->attr('href');
    }

    // データーベースにインサート
    foreach (array_map(null, $n, $price,$image,$link) as [$a, $b, $c, $d]){
      $a = str_replace(array("\r\n","\r","\n"), '', $a);
      $b = str_replace(array("\r\n","\r","\n"), '', $b);
      $c = str_replace(array("\r\n","\r","\n"), '', $c);
      $d = str_replace(array("\r\n","\r","\n"), '', $d);
      $hoge ="INSERT INTO serch_result_handlebars (name, price, image_url, click_url, site_name) VALUES ('"."$a"."', '"."$b"."', '"."$c"."', '"."$d"."', 'chainReactionCycles')";
      $db->exec($hoge);
    }
  }
?>
