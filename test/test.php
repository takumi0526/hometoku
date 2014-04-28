<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="admin.css">
    <title>テストツール</title>
  </head>
  <body>

    <p id="top_bar">テストツール</p>
    <div id="wrap">
      <!--
      <div id="head">
        <h1>社員登録</h1>
      </div>
      -->
      <div id="content">
        <p id="honbun">以下のフォームにテスト事項をご記入ください。</p>

        <form action="inport_test.php" method="post" enctype="multipart/form-data">

          <dl id="form_area">
            <dt>
            <span class="required">【必須】</span>社員ID
            </dt>
            <dd>
              <input type="text" name="staff_id" size="35" maxlength="255" value="1" >
            </dd>

            <dt>
             ほめられる回数(５まで)
            </dt>
            <dd>
              <select name="drop_data">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
              </dd>

            <dt>
             天気
            </dt>
  
            <dd>
            <select name="weather">
                <option value="0">はれ</option>
                <option value="1">快晴</option>
            </select>
            </dd>

            <dt>
             種ID(0-4まで)
            </dt>
            <dd>
              <select name="seed_id">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </dd>

            <dt>
               <span class="required">【必須】</span>floower_status:花の状態
            </dt>
            <dd>
              <input type="text" name="flower_status" size="35" maxlength="255" value="15" />
            </dd>
          </dl>

          <div>
            <input type="submit" value="テストを実行する"/>
          </div>

        </form>
      </div>
    </div>

  </body>
</html>