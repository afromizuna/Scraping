<?php
  require_once("./phpQuery-onefile.php");

  // データーベースに接続
  try {
    $db = new PDO('mysql:dbname=mounten;port=8889;host=127.0.0.1;charset=utf8','root','root');
  } catch (PDOException $e) {
    echo 'DB接続エラー: ' . $e->getMessage();
  }

    ////////////// 1:ハンドルバー////////////////////////
      $db->exec("TRUNCATE table serch_result_handlebars");

      // チェーン・リアクションMTBハンドルバーの検索結果
      $ht = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%83%8F%E3%83%B3%E3%83%89%E3%83%AB%E3%83%90%E3%83%BC?f=2258");

      // 検索結果の最大ページ数をカウント
      $pagination = count(phpQuery::newDocument($ht)->find("div")->find(".pagination")->find("a"));

      for($j=1;$j<=$pagination;$j++){
        $html = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%83%8F%E3%83%B3%E3%83%89%E3%83%AB%E3%83%90%E3%83%BC?f=2258&page=$j");

        // 検索結果のアイテム数をカウント
        $b = count(phpQuery::newDocument($html)->find("div")->find(".products_details_container"));

          for($i=0;$i<$b;$i++){
              $name[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".description")->find("a")->text();
              $price[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".fromamt")->text();
              $image[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('img')->attr('src');
              $link[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('a')->attr('href');
          }
        }
          // データーベースにインサート
          foreach (array_map(null, $name, $price,$image,$link) as [$name_replace, $price_replace, $image_replace, $link_replace]){
            $name_replace = str_replace(array("\r\n","\r","\n"), '', $name_replace);
            $price_replace = str_replace(array("\r\n","\r","\n"), '', $price_replace);
            $image_replace = str_replace(array("\r\n","\r","\n"), '', $image_replace);
            $link_replace = str_replace(array("\r\n","\r","\n"), '', $link_replace);
            $hoge ="INSERT INTO serch_result_handlebars (name, price, image_url, click_url, site_name) VALUES ('"."$name_replace"."', '"."$price_replace"."', '"."$image_replace"."', '"."$link_replace"."', 'chainReactionCycles')";
            $db->exec($hoge);
          }

    ////////////// 2:グリップ////////////////////////
      $db->exec("TRUNCATE table serch_result_grips");

      // チェーン・リアクションMTBハンドルバーの検索結果
      $ht = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%82%B0%E3%83%AA%E3%83%83%E3%83%97?f=2258");

      // 検索結果の最大ページ数をカウント
      $pagination = count(phpQuery::newDocument($ht)->find("div")->find(".pagination")->find("a"));

      for($j=1;$j<=$pagination;$j++){
        $html = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%82%B0%E3%83%AA%E3%83%83%E3%83%97?f=2258&page=$j");

        // 検索結果のアイテム数をカウント
        $b = count(phpQuery::newDocument($html)->find("div")->find(".products_details_container"));

          for($i=0;$i<$b;$i++){
              $name_grip[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".description")->find("a")->text();
              $price_grip[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".fromamt")->text();
              $image_grip[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('img')->attr('src');
              $link_grip[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('a')->attr('href');
          }
        }
          // データーベースにインサート
          foreach (array_map(null, $name_grip, $price_grip,$image_grip,$link_grip) as [$name_replace, $price_replace, $image_replace, $link_replace]){
            $name_replace = str_replace(array("\r\n","\r","\n"), '', $name_replace);
            $price_replace = str_replace(array("\r\n","\r","\n"), '', $price_replace);
            $image_replace = str_replace(array("\r\n","\r","\n"), '', $image_replace);
            $link_replace = str_replace(array("\r\n","\r","\n"), '', $link_replace);
            $hoge ="INSERT INTO serch_result_grips (name, price, image_url, click_url, site_name) VALUES ('"."$name_replace"."', '"."$price_replace"."', '"."$image_replace"."', '"."$link_replace"."', 'chainReactionCycles')";
            $db->exec($hoge);
          }

      ////////////// 3:ステム////////////////////////
        $db->exec("TRUNCATE table serch_result_stems");

        // チェーン・リアクションMTBハンドルバーの検索結果
        $ht = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%82%B9%E3%83%86%E3%83%A0?f=2258");

        // 検索結果の最大ページ数をカウント
        $pagination = count(phpQuery::newDocument($ht)->find("div")->find(".pagination")->find("a"));

        for($j=1;$j<=$pagination;$j++){
          $html = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%82%B9%E3%83%86%E3%83%A0?f=2258&page=$j");

        // 検索結果のアイテム数をカウント
          $b = count(phpQuery::newDocument($html)->find("div")->find(".products_details_container"));

            for($i=0;$i<$b;$i++){
                $name_stem[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".description")->find("a")->text();
                $price_stem[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".fromamt")->text();
                $image_stem[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('img')->attr('src');
                $link_stem[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('a')->attr('href');
            }
          }
            // データーベースにインサート
                foreach (array_map(null, $name_stem, $price_stem,$image_stem,$link_stem) as [$name_replace, $price_replace, $image_replace, $link_replace]){
                  $name_replace = str_replace(array("\r\n","\r","\n"), '', $name_replace);
                  $price_replace = str_replace(array("\r\n","\r","\n"), '', $price_replace);
                  $image_replace = str_replace(array("\r\n","\r","\n"), '', $image_replace);
                  $link_replace = str_replace(array("\r\n","\r","\n"), '', $link_replace);
                  $hoge ="INSERT INTO serch_result_stems (name, price, image_url, click_url, site_name) VALUES ('"."$name_replace"."', '"."$price_replace"."', '"."$image_replace"."', '"."$link_replace"."', 'chainReactionCycles')";
                  $db->exec($hoge);
                }

        ////////////// 4:サドル////////////////////////
          $db->exec("TRUNCATE table serch_result_sadlles");

          // チェーン・リアクションMTBハンドルバーの検索結果
          $ht = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%82%B5%E3%83%89%E3%83%AB?f=2258");

          // 検索結果の最大ページ数をカウント
          $pagination = count(phpQuery::newDocument($ht)->find("div")->find(".pagination")->find("a"));

          for($j=1;$j<=$pagination;$j++){
            $html = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%82%B5%E3%83%89%E3%83%AB?f=2258&page=$j");

          // 検索結果のアイテム数をカウント
            $b = count(phpQuery::newDocument($html)->find("div")->find(".products_details_container"));

              for($i=0;$i<$b;$i++){
                  $name_sadle[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".description")->find("a")->text();
                  $price_sadle[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".fromamt")->text();
                  $image_sadle[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('img')->attr('src');
                  $link_sadle[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('a')->attr('href');
              }
            }
              // データーベースにインサート
                  foreach (array_map(null, $name_sadle, $price_sadle,$image_sadle,$link_sadle) as [$name_replace, $price_replace, $image_replace, $link_replace]){
                    $name_replace = str_replace(array("\r\n","\r","\n"), '', $name_replace);
                    $price_replace = str_replace(array("\r\n","\r","\n"), '', $price_replace);
                    $image_replace = str_replace(array("\r\n","\r","\n"), '', $image_replace);
                    $link_replace = str_replace(array("\r\n","\r","\n"), '', $link_replace);
                    $hoge ="INSERT INTO serch_result_sadlles (name, price, image_url, click_url, site_name) VALUES ('"."$name_replace"."', '"."$price_replace"."', '"."$image_replace"."', '"."$link_replace"."', 'chainReactionCycles')";
                    $db->exec($hoge);
                  }

          ////////////// 5:シートポスト////////////////////////
            $db->exec("TRUNCATE table serch_result_seatposts");

            // チェーン・リアクションMTBハンドルバーの検索結果
            $ht = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%82%B7%E3%83%BC%E3%83%88%E3%83%9D%E3%82%B9%E3%83%88?f=2258");

            // 検索結果の最大ページ数をカウント
            $pagination = count(phpQuery::newDocument($ht)->find("div")->find(".pagination")->find("a"));

            for($j=1;$j<=$pagination;$j++){
              $html = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%82%B7%E3%83%BC%E3%83%88%E3%83%9D%E3%82%B9%E3%83%88?f=2258&page=$j");

            // 検索結果のアイテム数をカウント
              $b = count(phpQuery::newDocument($html)->find("div")->find(".products_details_container"));

                for($i=0;$i<$b;$i++){
                    $name_seatpost[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".description")->find("a")->text();
                    $price_seatpost[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".fromamt")->text();
                    $image_seatpost[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('img')->attr('src');
                    $link_seatpost[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('a')->attr('href');
                }
              }
                // データーベースにインサート
                    foreach (array_map(null, $name_seatpost, $price_seatpost,$image_seatpost,$link_seatpost) as [$name_replace, $price_replace, $image_replace, $link_replace]){
                      $name_replace = str_replace(array("\r\n","\r","\n"), '', $name_replace);
                      $price_replace = str_replace(array("\r\n","\r","\n"), '', $price_replace);
                      $image_replace = str_replace(array("\r\n","\r","\n"), '', $image_replace);
                      $link_replace = str_replace(array("\r\n","\r","\n"), '', $link_replace);
                      $hoge ="INSERT INTO serch_result_seatposts (name, price, image_url, click_url, site_name) VALUES ('"."$name_replace"."', '"."$price_replace"."', '"."$image_replace"."', '"."$link_replace"."', 'chainReactionCycles')";
                      $db->exec($hoge);
                    }

            ////////////// 6:ペダル////////////////////////
              $db->exec("TRUNCATE table serch_result_pedals");

              // チェーン・リアクションMTBハンドルバーの検索結果
              $ht = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%83%9A%E3%83%80%E3%83%AB?f=2258");

              // 検索結果の最大ページ数をカウント
              $pagination = count(phpQuery::newDocument($ht)->find("div")->find(".pagination")->find("a"));

              for($j=1;$j<=$pagination;$j++){
                $html = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%83%9A%E3%83%80%E3%83%AB?f=2258&page=$j");

              // 検索結果のアイテム数をカウント
                $b = count(phpQuery::newDocument($html)->find("div")->find(".products_details_container"));

                  for($i=0;$i<$b;$i++){
                      $name_pedal[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".description")->find("a")->text();
                      $price_pedal[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".fromamt")->text();
                      $image_pedal[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('img')->attr('src');
                      $link_pedal[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('a')->attr('href');
                  }
                }
                  // データーベースにインサート
                      foreach (array_map(null, $name_pedal, $price_pedal,$image_pedal,$link_pedal) as [$name_replace, $price_replace, $image_replace, $link_replace]){
                        $name_replace = str_replace(array("\r\n","\r","\n"), '', $name_replace);
                        $price_replace = str_replace(array("\r\n","\r","\n"), '', $price_replace);
                        $image_replace = str_replace(array("\r\n","\r","\n"), '', $image_replace);
                        $link_replace = str_replace(array("\r\n","\r","\n"), '', $link_replace);
                        $hoge ="INSERT INTO serch_result_pedals (name, price, image_url, click_url, site_name) VALUES ('"."$name_replace"."', '"."$price_replace"."', '"."$image_replace"."', '"."$link_replace"."', 'chainReactionCycles')";
                        $db->exec($hoge);
                      }

              ////////////// 7:クランク////////////////////////
                $db->exec("TRUNCATE table serch_result_cranks");

                // チェーン・リアクションMTBハンドルバーの検索結果
                $ht = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%82%AF%E3%83%A9%E3%83%B3%E3%82%AF%E3%82%BB%E3%83%83%E3%83%88?f=2258");

                // 検索結果の最大ページ数をカウント
                $pagination = count(phpQuery::newDocument($ht)->find("div")->find(".pagination")->find("a"));

                for($j=1;$j<=$pagination;$j++){
                  $html = file_get_contents("https://www.chainreactioncycles.com/jp/ja/%E3%82%AF%E3%83%A9%E3%83%B3%E3%82%AF%E3%82%BB%E3%83%83%E3%83%88?f=2258&page=$j");

                // 検索結果のアイテム数をカウント
                  $b = count(phpQuery::newDocument($html)->find("div")->find(".products_details_container"));

                    for($i=0;$i<$b;$i++){
                        $name_crank[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".description")->find("a")->text();
                        $price_crank[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find(".fromamt")->text();
                        $image_crank[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('img')->attr('src');
                        $link_crank[] = phpQuery::newDocument($html)->find("div")->find(".products_details_container:eq($i)")->find('a')->attr('href');
                    }
                  }
                    // データーベースにインサート
                        foreach (array_map(null, $name_crank, $price_crank,$image_crank,$link_crank) as [$name_replace, $price_replace, $image_replace, $link_replace]){
                          $name_replace = str_replace(array("\r\n","\r","\n"), '', $name_replace);
                          $price_replace = str_replace(array("\r\n","\r","\n"), '', $price_replace);
                          $image_replace = str_replace(array("\r\n","\r","\n"), '', $image_replace);
                          $link_replace = str_replace(array("\r\n","\r","\n"), '', $link_replace);
                          $hoge ="INSERT INTO serch_result_cranks (name, price, image_url, click_url, site_name) VALUES ('"."$name_replace"."', '"."$price_replace"."', '"."$image_replace"."', '"."$link_replace"."', 'chainReactionCycles')";
                          $db->exec($hoge);
                        }

?>
