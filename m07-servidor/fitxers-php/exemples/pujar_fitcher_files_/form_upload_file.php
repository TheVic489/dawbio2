<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!--<!DOCTYPE html>-->
<!--<html>--> 
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <!--<meta charset="UTF-8" />-->
            <title>DNA form</title>
            <link rel="stylesheet" type="text/css" href="css/styles.css" />
      </head>
      <body>
            <form action="form_upload_file_result.php" method="post" enctype="multipart/form-data">
                  <h1>DNA form</h1>

                  <fieldset>
                        <legend>Data</legend>
                        <p>
                              <label>Enter sequence name: *</label>
                              <input type="text" name="sequence_name" size="50" maxlength="50" />
                        </p>

                        <p>
                              <label>Enter the sequence in the box below: *</label>
                              <textarea name="sequence" cols="50" rows="5"></textarea>
                        </p>

                        <p>
                              <label>The DNA sequence is: *</label>
                              <select name="sequence_type">
                                    <option value="" selected="selected">select a type</option>
                                    <option value="linear">linear</option>
                                    <option value="circular">circular</option>
                              </select>
                        </p>  

                        <p>* Required fields</p>                                       
                  </fieldset>

                  <fieldset>
                        <legend>Image</legend>
                        <p>
                              <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                              <input type="file" name="filename" />
                        </p>
                  </fieldset>

                  <p>
                        <input type="submit" name="form_submit" value="Submit" />
                        <input type="reset" name="form_reset" value="Reset" />
                  </p>
            </form>	
      </body>
</html>