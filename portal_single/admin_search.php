<?php
require_once("config.php");
require_once("func.php");
check_ip($ip_white_list);
$mysqli=new mysqli($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME,$DB_PORT);
$mysqli->set_charset("utf8");
?>﻿
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>搜索引擎</title>
    <link href="css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="css/materializecss-font.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/materialize.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript">
      $(document).ready(function() {
        $('.modal').modal();
      });
    </script>
  </head>
  <body>
    <header>
      <ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(0%);">
        <li>
          <div class="userView" style="height: 140px">
            <div class="background">
              <img src="images/header.jpg" >
            </div>
          </div>
        </li>
        <li><a class="waves-effect active teal" href="#"><i class="material-icons">search</i>搜索引擎</a></li>
        <li><a class="waves-effect" href="#!"><i class="material-icons">language</i>站点</a></li>
        <li><a class="waves-effect" href="#!"><i class="material-icons">group_work</i>悬浮按钮</a></li>
        <li><a class="waves-effect" href="#!"><i class="material-icons">perm_media</i>背景</a></li>
        <li><div class="divider"></div></li>
        <li><a href="portal.php" class="btn waves-effect waves-teal">预览</a></li>
      </ul>
    </header>
    <main>
      <nav class="top-nav teal">
        <div class="container">
          <div class="nav-wrapper"><a class="page-title">搜索引擎</a></div>
        </div>
      </nav>
      <div class="container">
        <button  data-target="modal_add" type="button" class="btn blue" style="margin-top: 20px">添加</button>
        <form name="form" method="get" action="modify_search.php">
          <div id="modal_add" class="modal">
            <div class="modal-content">
              <h4>添加搜索引擎</h4>
                <div class="input-field">
                  <input name="name" id="name" type="text" class="validate">
                  <label for="name">名称</label>
                </div>
                <div class="input-field">
                  <input name="url" id="url" type="text" class="validate">
                  <label for="url">搜索链接</label>
                </div>
            </div>
            <div class="modal-footer">
              <button class="modal-action modal-close waves-effect waves-red btn-flat ">取消</button>
              <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">确定</button>
            </div>
          </div>
        </form>
        <table class="responsive-table highlight">
          <thead>
            <tr>
                <th>编号</th>
                <th>名称</th>
                <th>搜索链接</th>
                <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $stmt=$mysqli->prepare("select * from search");
              $stmt->execute();
              $result = $stmt->get_result();
            ?>
            <?php while ($row = $result->fetch_assoc()) {?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['url']; ?></td>
                <td>
                  <a class="waves-effect waves-light btn btn-sm btn-success" data-target="modal_update_<?php echo $row['id']; ?>">修改</a>
                  <a type="submit" class="waves-effect waves-light btn red lighten-1" data-target="modal_delete_<?php echo $row['id']; ?>">删除</a>
                  <form name="form" method="get" action="modify_search.php">
                    <div id="modal_update_<?php echo $row['id']; ?>" class="modal">
                      <div class="modal-content">
                        <h4>修改搜索引擎</h4>

                          <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>"/>
                          <div class="input-field">
                            <input name="name" id="name" type="text" class="validate" value="<?php echo $row['name']; ?>">
                            <label for="name">名称</label>
                          </div>
                          <div class="input-field">
                            <input name="url" id="url" type="text" class="validate" value="<?php echo $row['url']; ?>">
                            <label for="url">搜索链接</label>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button class="modal-action modal-close waves-effect waves-red btn-flat ">取消</button>
                        <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">提交</button>
                      </div>
                    </form>
                  </div>
                  <form name="form" method="get" action="modify_search.php">
                    <div id="modal_delete_<?php echo $row['id']; ?>" class="modal">
                      <div class="modal-content">
                        <h4>确定要删除<?php echo $row['name']; ?>吗？</h4>

                          <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>"/>
                      </div>
                      <div class="modal-footer">
                        <button class="modal-action modal-close waves-effect waves-red btn-flat ">取消</button>
                        <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">确定</button>
                      </div>
                    </form>
                  </div>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </main>
  </body>
</html>
<?php mysqli_close($mysqli);?>﻿