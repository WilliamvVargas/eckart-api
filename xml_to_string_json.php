<?php

$xml = '<?xml version="1.0" encoding="utf-8"?>
<LgfData>
  <Header>
    <DocumentVersion>24D</DocumentVersion>
    <OriginSystem>QAD</OriginSystem>
    <ClientEnvCode>QA</ClientEnvCode>
    <ParentCompanyCode>ECKART</ParentCompanyCode>
    <Entity>purchase_order</Entity>
    <MessageId>PurchaseOrder</MessageId>
  </Header>
  <ListOfPurchaseOrders>
    <purchase_order>
      <purchase_order_hdr>
        <po_nbr>OC22920</po_nbr>
        <facility_code>FRAGUA</facility_code>
        <company_code>ECKART</company_code>
        <vendor_code>55555640</vendor_code>
        <action_code>CREATE</action_code>
        <ord_date>2025-03-21</ord_date>
        <po_type>IMP</po_type>
        <delivery_date>2025-03-21</delivery_date>
        <ship_date>2025-03-21</ship_date>
        <cancel_date>2025-03-21</cancel_date>
     </purchase_order_hdr>
     <purchase_order_dtl>
        <seq_nbr>1</seq_nbr>
        <action_code>CREATE</action_code>
        <item_part_a>100287</item_part_a>
        <ord_qty>15000</ord_qty>
        <unit_cost>2</unit_cost>
        <unit_retail>0</unit_retail>
      </purchase_order_dtl>
    </purchase_order>
  </ListOfPurchaseOrders>
</LgfData>';

// Asegurar que el XML se mantenga en formato string
$xmlString = trim($xml);

// Crear el JSON con el XML como parámetro
$jsonData = json_encode(["data" => $xmlString]);

// Enviar el JSON
header("Content-Type: application/json");
echo $jsonData;

?>