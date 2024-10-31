<div class="page-content">
  <div class="content">
    <div class="page-title"> </div>    
    <div class="row">  
      <div class="col-md-12" style="color: black;">
        <h3>Welcome, <strong><?php echo $this->session->userdata('first_name')?></strong></h3>
        <!-- <h2 class="text-center"> <strong>Digital Work Schedule Management System</strong></h2> -->

        <style type="text/css">
         .tg  {border-collapse:collapse;border-spacing:0; width: 100%}
         .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px; border-color:#ddd;overflow:hidden;word-break:normal; color: black; }
         .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px; border-color:#ddd;overflow:hidden;word-break:normal; color: black; font-weight: bold; vertical-align: top; width: 170px;text-align:right;}
         .tg .tg-d8ej{background-color:#90c7f3}
         .tg .tg-031e{background-color: #aed1ec;}
       </style>

       <div class="row">

        <div class="col-md-12">
          <!-- <div id="infoMessage"><?php //echo $message;?></div> -->
          <table class="tg">
          <caption style="color: black;">My Basic Information</caption>
            <tr>
             <th class="tg-d8ej"> Name </th>
             <td class="tg-031e"><strong><?=$user->first_name?></strong></td>
           </tr>                  
           <tr>
             <th class="tg-d8ej"> Email </th>
             <td class="tg-031e"><?=$user->email?></td>
           </tr>
           <tr>
             <th class="tg-d8ej"> Mobile </th>
             <td class="tg-031e"><strong><?=$user->phone?></strong></td>
           </tr>
           <tr>
             <th class="tg-d8ej"> Org. / Office Name </th>
             <td class="tg-031e"><?=$user->org_prof_name?></td>
           </tr>
         </table>
       </div>

     </div> <!-- /row -->

        <!-- <div class="alert alert-block alert-success fade in">        
          <h4 class="alert-heading"><i class="icon-warning-sign"></i> Thank You! Your request sent successfully.</h4>
          <p> Please, wait for your approval.</p>
          <div class="button-set">
            <a class="btn btn-white btn-cons" href="<?=base_url('my-submitted-information');?>">My submitted information</a>
          </div>
        </div> -->

      </div>
    </div>
  </div>
</div>