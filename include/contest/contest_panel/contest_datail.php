
      <div class="contest_add_bodyy">
        <div id="contest_detail_load"></div>
        <div class="add_field_body" id="contest_detail_body">

        <table width="100%">
          
          <tr>
            <td class="td_title">
              <div class="title_div">Contest Name</div>
            </td>
            <td class="td_content">
              <textarea class="add_input_box" id="name" placeholder="Enter Contest Name"></textarea>
            </td>
          </tr>

          <tr>
            <td class="td_title">
              <div class="title_div">Contest Start : </div>
            </td>
            <td class="td_content">
              <input class="input_date_box" type="datetime-local" id="start" name="bday" min="2018-10-02">
            </td>
          </tr>
          <tr>
            <td class="td_title">
              <div class="title_div">Contest End : </div>
            </td>
            <td class="td_content">
              <input id="end" class="input_date_box" type="datetime-local" name="bday" min="2018-10-02">
            </td>
          </tr>
          <tr>
            <td class="td_title">
              <div class="title_div">Contest Type : </div>
            </td>
            <td class="td_content">
              <select id="type" class="select_type">
                <option value="1">Public</option>
                <option value="2">Private</option>
              </select>
            </td>
          </tr>
          <tr>
            <td class="td_title">
              <div class="title_div">Contest Description : </div>
            </td>
            <td class="td_content">
              <textarea name="editor1" class="editor" id="editor1" rows="10" cols="80">
              </textarea>
            </td>
          </tr>
        </table>
        <center>
     <button class="add_contest_btn">Media</button>
     <button class="add_contest_btn" id="update_btn" onclick="update_contest()">Update Contest</button>
    </center>
  </div>
</div>

<script type="text/javascript">
        data="<?php echo $info_en; ?>";
        set_contest_info(data);
</script>
   
