<div>
  <h2>Donate Nashville Export</h2>
  <form action="<?php echo url_for('@export?sf_format=xls')?>" method="post">
    <table>
      <tr>
        <td><label>Filename: </label></td>
        <td><input name="title" value="Donate_Nashville_Export" type="text" ></input></td>
      </tr>
      <tr>
        <td><label>Include Timestamp: </label></td>
        <td><input name="include_timestamp" checked="checked" type="checkbox" ></input></td>
      </tr>
    </table>
    <input value="Export" type="submit" ></input>
  </form>
</div>