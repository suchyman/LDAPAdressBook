function telefonNumbersF() { 
 $stringTR='';
  $ldap = ldap_connect("IpLdapServer");
  ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

  if ($ldap && $bind = @ldap_bind($ldap, "login@yourDomain", "Password")) {
      $query = ldap_search($ldap, "OU=X,OU=X,OU=X,DC=X,DC=X,DC=X", "(cn=*)");
      
$data = ldap_get_entries($ldap, $query);

for ($i=0; $i < $data['count']; $i++) {
  if (($data[$i]['mail'][0]!='') && ($data[$i]['telephonenumber'][0]!='')){
      $tel=$data[$i]['telephonenumber'][0];
  $stringTR .= '<tr> <th>' . $data[$i]['name'][0] . '</th><th>' . $data[$i]['mail'][0] . '</th><th>' . $tel . '</th></tr>';  
  }
}
  }
	$string .= '
	<div class="container">
  <input class="form-control mb-4" id="tableSearch" type="text"
    placeholder="Zacznij wpisywać..">

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Imię i nazwisko</th>
        <th>E-mail</th>
        <th>Telefon</th>
      </tr>
    </thead>
    <tbody id="myTable">
      '.$stringTR.'
    </tbody>
  </table>
</div>
<script>
jQuery(document).ready(function($){
	$("#tableSearch").on("keyup", function() {
	  var value = $(this).val().toLowerCase();
	  $("#myTable tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	  });
	});
  });
</script>	
	';
	return $string; 
	}
	// Register shortcode
add_shortcode('telefonNumbers', 'telefonNumbersF');
