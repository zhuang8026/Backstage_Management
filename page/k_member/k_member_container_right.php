<div class="table-wrapper">
    <div class="table-title">
        <div class="row">
        <div class="col-sm-6 user_btn">
            <!-- <img style="width: 47px; margin-right: 10px; border-radius: 2px;" src="../../asset/img/manangeicon.png" alt="管理者頭像"> -->
            <h2>
                <b>Admin : <?= $_SESSION['username'] ?></b>
            </h2>
            <!-- <button>
                <i class="fas fa-sign-out-alt"></i>
                <a href="../../api/logout_api.php?logout=1">logout</a>
            </button> -->
        </div>
            
            <!-- 刪除 與 新增 -->
            <div class="col-sm-6">
                <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal" id="member_add">
                    <i class="material-icons">&#xE147;</i> <span>新增會員</span>
                </a>
                    <a href="#deleteEmployeeModal_all" class="btn btn-danger" data-toggle="modal">
                    <i class="material-icons" onClick="seller_Delete_click_all()">&#xE15C;</i> <span>刪除</span>
                </a>
            </div>
        </div>
    </div>

    <!-- <div id="chart"></div> -->
    <table class="table table-striped table-hover" id="dt-table" data-aos="fade-up">
        <thead>
            <!-- 標頭 -->
            <tr>
                <th>
                    <span class="custom-checkbox">
                        <input type="checkbox" id="selectAll">
                        <label for="selectAll"></label>
                    </span>
                </th>
                <!-- <th></th> -->
                <th>使用者名稱</th>
                <th>使用者密碼</th>
                <th>姓名</th>
                <th>性別</th>
                <th>使用者頭像</th>
                <th>手機號碼</th>
                <th>信用卡號碼</th>
                <th>出生年月日</th>
                <th>地址</th>
                <th>開通狀況</th>
                <th>編輯刪除</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT `id`, `username`, `pwd`, `name`, `gender`, IF(`gender` = 1,'男','女') AS`genderdata`, `userlogo`, `phoneNumber`,`card`,`birthday`,`address`,
                    IF(`isActivated` = 1,'開通','未開通') AS `isActivated`
                    FROM `users`
                    -- WHERE `isActivated` = 1 
                    ORDER BY `id` ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                for($i = 0; $i < count($arr); $i++) {
            ?>

            <tr>
                <td>
                    <span class="custom-checkbox">
                        <input type="checkbox" class="checkboxValue" id="checkbox<?= $arr[$i]['id']; ?>" name="options[]" value="<?= $arr[$i]['id']; ?>">
                        <label for="checkbox1"></label>
                    </span>
                </td>
                <td class="username<?php echo $arr[$i]['id']?>"><?php echo $arr[$i]['username']; ?></td>
                <td class="pwd<?php echo $arr[$i]['id']?>"><?php echo $arr[$i]['pwd']; ?></td>
                <td class="name<?php echo $arr[$i]['id']?>"><?php echo $arr[$i]['name']; ?></td>
                
                <td >
                    <input class="genderdata<?php echo $arr[$i]['id']?>" type="hidden" value="<?= $arr[$i]['gender']?>">
                    <?php echo $arr[$i]['genderdata']; ?>
                </td>
                
                <!-- <td class="userlogo<?php echo $arr[$i]['id']?>">
                    <?php if($arr[$i]['userlogo'] !== NULL) { ?>
                    <img class="w200px" src="./files/<?php echo $arr[$i]['userlogo']; ?>">
                    <?php } ?>
                </td> -->

                <td class="userlogo<?= $arr[$i]['id']; ?>">
                    <?php if($arr[$i]['userlogo'] !== ""): ?>
                        <img src="./files/<?= $arr[$i]['userlogo'];?>">
                    <?php else: ?>
                        <img src="./files/404.png">
                    <?php endif; ?>
                </td>

                <td class="phoneNumber<?php echo $arr[$i]['id']?>"><?php echo $arr[$i]['phoneNumber']; ?></td>
                <td class="card<?php echo $arr[$i]['id']?>"><?php echo $arr[$i]['card']; ?></td>
                <td class="birthday<?php echo $arr[$i]['id']?>"><?php echo $arr[$i]['birthday']; ?></td>
                <td class="address<?php echo $arr[$i]['id']?>"><?php echo $arr[$i]['address']; ?></td>
                <td class="isActivated<?php echo $arr[$i]['id']?>"><?php echo $arr[$i]['isActivated']; ?></td>
                <td>
                    <a href="#editEmployeeModal" class="edit" data-toggle="modal">
                    <i class="material-icons" data-toggle="tooltip" title="編輯" onClick="Edit_k_member(<?php echo $arr[$i]['id']?>)">&#xE254;</i>
                    </a>

                    <a href="#deleteEmployeeModal" class="delete" data-toggle="modal" >
                        <i class="material-icons" data-toggle="tooltip" title="刪除" onClick="Delete_k_member(<?php echo $arr[$i]['id']?>)">&#xE872;</i>
                    </a>
                </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="10">沒有資料</td>
                </tr>
            <?php
            }
            ?>
        
        </tbody>
    </table>
        
</div>