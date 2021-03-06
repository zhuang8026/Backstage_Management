<!--  以下為點擊出現的畫面  -->
    <!-- 增加 -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="myForm" method="POST" action="../../api/yy_add_api.php" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">新增賣場</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name / 賣場名稱</label>
                            <input type="text" class="form-control" required name="storeName" value="" placeholder="賣場名稱">
                        </div>
                        <div class="form-group">
                            <label>Image / 賣場圖片</label>
                            <input type="file" class="form-control" name="storeImg" value="" placeholder="賣場頭像">
                        </div>
                        <div class="form-group">
                            <label>Description / 賣場描述</label>
                            <textarea class="form-control" required name="storeDescription" value="" placeholder="賣場描述"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Sellers / 賣家</label>
                            <select name="sellersId" required class="form-control" id="sellersId">
                            <?php
                                $sql = "SELECT `id`, `username`, `name`
                                        FROM `users` 
                                        LEFT JOIN `stores`
                                        ON `users`.`id` = `stores`.`storeId`
                                        WHERE `isActivated` = 1";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute();
                                if($stmt->rowCount() > 0):
                                    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    for($i = 0; $i < count($arr); $i++):
                            ?>
                                <option value="<?= $arr[$i]['id']; ?>" class="form-control" class="form-control">ID: <?= $arr[$i]['username'] ?>｜名字: <?= $arr[$i]['name'] ?></option>
                                <?php endfor; ?>
                            <?php endif; ?>

                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 修改 -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="updateForm" enctype="multipart/form-data" method="POST" action="../../api/yy_updateEdit_api.php">
                    <div class="modal-header">
                        <h4 class="modal-title">編輯 ?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name / 賣場名稱</label>
                            <input type="text" class="form-control" name="yyeditName" value="" placeholder="商品名稱" id="yyeditName">
                        </div>
                        <!-- 擁有者更改 ? -->
                        <div class="form-group">
                            <label>sellers / 擁有者編輯</label>
                            <select name="yyeditIdSelect" required class="form-control" id="yyeditIdSelect">
                                <option value="0" class="form-control" class="form-control">平台所有</option>
                                <?php
                                    $sql = "SELECT `id`, `username`, `name`
                                            FROM `users` 
                                            LEFT JOIN `stores`
                                            ON `users`.`id` = `stores`.`storeId`
                                            WHERE `isActivated` = 1";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    if($stmt->rowCount() > 0):
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        for($i = 0; $i < count($arr); $i++):
                                ?>
                                    <option value="<?= $arr[$i]['id']; ?>" class="form-control" class="form-control">ID: <?= $arr[$i]['username'] ?>｜名字: <?= $arr[$i]['name'] ?></option>
                                    <?php endfor; ?>
                                <?php endif; ?>

                            </select>
                        </div>
                        <!-- 權限 -->
                        <div class="form-group">
                            <label> opened / 賣場開通狀態</label>
                            <select name="isActivated" id="isActivated" class="form-control">
                                <option value="0" class="form-control" >未開通</option>
                                <option value="1" class="form-control" selected>開通</option>
                            </select>
                        </div>
                        <!-- 圖片 -->
                        <div class="form-group">
                            <label style="display: block;">Image / 原始</label>
                            <img id="itemImg_d_img" src=""/>
                            <label style="display: block;">Image / 修改</label>
                            <input type="file" class="form-control" name="storeImg_d" value="" id="storeImg_d">
                        </div>
                        <!-- 介紹 -->
                        <div class="form-group">
                            <label>Description / 賣場描述</label>
                            <textarea class="form-control" required id="yyeditIdcontent" name="yyeditIdcontent" value="" placeholder="賣場描述"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" id="btn_submit" value="Save">
                    </div>
                    <input type="hidden" name="itemId_input" id="itemId_input" value="">
                </form>
            </div>
        </div>
    </div>

    <!-- 刪除 -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="deleteForm" method="POST" action="../../api/yy_delete_api.php" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">刪除 ?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>您確定要刪除這些記錄嗎 ？</p>
                        <p class="text-warning"><small>此操作無法取消</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                    <input type="hidden" name="yy_input_delete_id" id="yy_input_delete_id" value="">
                </form>
            </div>
        </div>
    </div>

    <!-- 刪除 全部 -->
    <div id="deleteEmployeeModal_all" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="deleteAllForm" method="POST" action="../../api/yy_delete_all_api.php" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">刪除所有選擇 ?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>您確定要刪除這些記錄嗎 ？</p>
                        <p class="text-warning"><small>此操作無法取消</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                    <input type="hidden" name="yy_input_delete_all_id[]" id="yy_input_delete_all_id" value="" placeholder="傳輸刪除ID">
                    <input type="hidden" name="yy_input_delete_all_username[]" id="yy_input_delete_all_username" value="" placeholder="傳輸刪除username">
                </form>
            </div>
        </div>
    </div>