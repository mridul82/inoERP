<?php
 if ($$class->po_type != 'STANDARD') {
  return;
 }
 $po_line_id = $po_line->po_line_id;
 if (!empty($po_line_id)) {
  $po_detail_object = po_detail::find_by_po_lineId($po_line_id);
 } else {
  $po_detail_object = array();
 }
 if (count($po_detail_object) == 0) {
  $po_detail = new po_detail();
  $po_detail_object = array();
  array_push($po_detail_object, $po_detail);
 }
?>
 <div class="class_detail_form">
  <fieldset class="form_detail_data_fs"><legend>Detail Data</legend>
   <div class="tabsDetail">
    <ul class="tabMain">
     <li class="tabLink"><a href="#tabsDetail-1-1">Basic</a></li>
     <li class="tabLink"><a href="#tabsDetail-2-1">Delivery</a></li>
     <li class="tabLink"><a href="#tabsDetail-3-1">Finance</a></li>
     <li class="tabLink"><a href="#tabsDetail-4-1">Status</a></li>
    </ul>
    <div class="tabContainer">
     <div id="tabsDetail-1-1" class="tabContent">
      <table class="form form_detail_data_table detail">
       <thead>
        <tr>
         <th>Action</th>
         <th>Seq#</th>
         <th>Shipment Id</th>
         <th>Shipment Number</th>
         <!--<th>Inventory</th>-->
         <th>Ship To Location</th>
         <th>Quantity</th>
         <th>Need By Date</th>
         <th>Promise Date</th>

        </tr>
       </thead>
       <tbody class="form_data_detail_tbody">
        <?php
         $detailCount = 0;
         foreach ($po_detail_object as $po_detail) {
          $class_third = 'po_detail';
          $$class_third = &$po_detail;
          ?>
          <tr class="po_detail<?php echo $count . '-' . $detailCount; ?><?php echo $detailCount != 0 ? ' new_object' : '' ?>">
           <td>   
            <ul class="inline_action">
             <li class="add_row_detail_img"><img  src="<?php echo HOME_URL; ?>themes/images/add.png"  alt="add new line" /></li>
             <li class="remove_row_img"><img src="<?php echo HOME_URL; ?>themes/images/remove.png" alt="remove this line" /> </li>
             <li><input type="checkbox" name="detail_id_cb" value="<?php echo htmlentities($po_detail->po_detail_id); ?>"></li>           
             <li><?php echo form::hidden_field('po_line_id', $po_line->po_line_id); ?></li>
             <li><?php echo form::hidden_field('po_header_id', $po_header->po_header_id); ?></li>

            </ul>
           </td>
           <td><?php $f->seq_field_detail_d($detailCount) ?></td>
           <td><?php form::text_field_wid3sr('po_detail_id'); ?></td>
           <td><?php echo $f->number_field('shipment_number', $$class_third->shipment_number, '', '', 'detail_number', 1); ?></td>
           <td><?php $f->text_field_wid3('ship_to_location_id'); ?></td>
           <td><?php echo $f->number_field('quantity', $$class_third->quantity); ?></td>
           <td><?php echo $f->date_fieldFromToday_mr('need_by_date', ($$class_third->need_by_date), false); ?></td>
           <td><?php echo $f->date_fieldFromToday('promise_date', ($$class_third->promise_date)); ?></td>

          </tr>
          <?php
          $detailCount++;
         }
        ?>
       </tbody>
      </table>
     </div>
     <div id="tabsDetail-2-1" class="tabContent">
      <table class="form form_detail_data_table detail">
       <thead>
        <tr>
         <th>Seq#</th>
         <th>Sub inventory</th>
         <th>Locator</th>
         <th>Requestor</th>
         <th>Invoice Match Type</th>
        </tr>
       </thead>
       <tbody class="form_data_detail_tbody">
        <?php
         $detailCount = 0;
         foreach ($po_detail_object as $po_detail) {
          $class_third = 'po_detail';
          $$class_third = &$po_detail;
          ?>
          <tr class="po_detail<?php echo $count . '-' . $detailCount; ?> <?php echo $detailCount != 0 ? ' new_object' : '' ?>">
           <td><?php $f->seq_field_detail_d($detailCount) ?></td>
           <td>
            <?php echo $f->select_field_from_object('subinventory_id', subinventory::find_all_of_org_id($$class_second->receving_org_id), 'subinventory_id', 'subinventory', $$class_third->subinventory_id, '', 'subinventory_id copyValue', ''); ?>
           </td>
           <td>
            <?php echo $f->select_field_from_object('locator_id', locator::find_all_of_subinventory($$class_third->subinventory_id), 'locator_id', 'locator', $$class_third->locator_id, '', 'locator_id copyValue', ''); ?>
           </td>
           <td><?php $f->text_field_wid3('requestor'); ?></td>
           <td><?php echo $f->select_field_from_array('invoice_match_type', po_detail::$invoice_match_type_a, $$class_third->invoice_match_type); ?></td>
          </tr>
          <?php
          $detailCount++;
         }
        ?>
       </tbody>
      </table>
     </div>
     <div id="tabsDetail-3-1" class="tabContent">
      <table class="form form_detail_data_table detail">
       <thead>
        <tr>
         <th>Seq#</th>
         <th>Charge Ac</th>
         <th>Accrual Ac</th>
         <th>Budget Ac</th>
         <th>PPV Ac</th>
        </tr>
       </thead>
       <tbody class="form_data_detail_tbody">
        <?php
         $detailCount = 0;
         foreach ($po_detail_object as $po_detail) {
          $class_third = 'po_detail';
          $$class_third = &$po_detail;
          ?>
          <tr class="po_detail<?php echo $count . '-' . $detailCount; ?><?php echo $detailCount != 0 ? ' new_object' : '' ?>">
           <td><?php $f->seq_field_detail_d($detailCount) ?></td>
           <td><?php $f->ac_field_wid3m('charge_ac_id', 'copyValue'); ?></td>
           <td><?php $f->ac_field_wid3m('accrual_ac_id', 'copyValue'); ?></td>
           <td><?php $f->ac_field_wid3('budget_ac_id', 'copyValue'); ?></td>
           <td><?php $f->ac_field_wid3m('ppv_ac_id', 'copyValue'); ?></td>
          </tr>
          <?php
          $detailCount++;
         }
        ?>
       </tbody>
      </table>
     </div>
     <div id="tabsDetail-4-1" class="tabContent">
      <table class="form form_detail_data_table detail"><lable>Quantities</lable>
       <thead>
        <tr>
         <th>Seq#</th>
         <th>Received</th>
         <th>Accepted</th>
         <th>Delivered</th>
         <th>Invoiced</th>
         <th>Paid</th>
        </tr>
       </thead>
       <tbody class="form_data_detail_tbody">
        <?php
         $detailCount = 0;
         foreach ($po_detail_object as $po_detail) {
          $class_third = 'po_detail';
          $$class_third = &$po_detail;
          ?>
          <tr class="po_detail<?php echo $count . '-' . $detailCount; ?> <?php echo $detailCount != 0 ? ' new_object' : '' ?>">
           <td><?php $f->seq_field_detail_d($detailCount) ?></td>
           <td><?php form::number_field_wid3sr('received_quantity'); ?></td>
           <td><?php form::number_field_wid3sr('accepted_quantity'); ?></td>
           <td><?php form::number_field_wid3sr('delivered_quantity'); ?></td>
           <td><?php form::number_field_wid3sr('invoiced_quantity'); ?></td>
           <td><?php form::number_field_wid3sr('paid_quantity'); ?></td>
          </tr>
          <?php
          $detailCount++;
         }
        ?>
       </tbody>
      </table>
     </div>

    </div>
   </div>


  </fieldset>

 </div>