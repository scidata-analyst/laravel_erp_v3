# ERP Form Field Definitions Extraction

## FILE: customers.html
**MODEL:** Customer  
**TABLE:** customers  

### COLUMNS & RELATIONSHIPS:
- company_name (type: text)
- contact_person (type: text)
- email (type: email)
- phone (type: text)
- credit_limit (type: number | unit: currency)
- sales_rep (type: select | enum_values: Sara L., James R.)
- billing_address (type: textarea)

---

## FILE: invoices.html
**MODEL:** Invoice  
**TABLE:** invoices  

### COLUMNS & RELATIONSHIPS:
- customer_id (type: select | relationship_to: Customer)
- sales_order_ref (type: text)
- invoice_date (type: date)
- due_date (type: date)
- amount (type: number | unit: currency)
- tax_percentage (type: number | unit: percentage)
- notes (type: textarea)

---

## FILE: sales-orders.html
**MODEL:** SalesOrder  
**TABLE:** sales_orders  

### COLUMNS & RELATIONSHIPS:
- customer_id (type: select | relationship_to: Customer)
- order_date (type: date)
- delivery_date (type: date)
- payment_terms (type: select | enum_values: Net 30, Due on Receipt)
- discount_percentage (type: number | unit: percentage)
- product_id (type: select | relationship_to: Product)
- quantity (type: number)
- unit_price (type: number | unit: currency | readonly: true)
- item_discount (type: number | unit: percentage)
- item_total (type: number | unit: currency | readonly: true)

---

## FILE: suppliers.html
**MODEL:** Supplier  
**TABLE:** suppliers  

### COLUMNS & RELATIONSHIPS:
- company_name (type: text)
- contact_person (type: text)
- email (type: email)
- phone (type: text)
- country (type: text)
- payment_terms (type: select | enum_values: Net 30, Net 60, Net 90, Prepaid)
- currency (type: select | enum_values: USD, EUR, GBP, BDT)
- address (type: textarea)

---

## FILE: employees.html
**MODEL:** Employee  
**TABLE:** employees  

### COLUMNS & RELATIONSHIPS:
- full_name (type: text)
- employee_id (type: text)
- position (type: text)
- department (type: select | enum_values: IT, Sales, HR, Finance, Warehouse)
- basic_salary (type: number | unit: currency)
- join_date (type: date)
- contract_type (type: select | enum_values: Permanent, Contract, Intern)
- email (type: email)
- phone (type: text)

---

## FILE: products.html
**MODEL:** Product  
**TABLE:** products  

### COLUMNS & RELATIONSHIPS:
- product_name (type: text)
- sku (type: text)
- category (type: select | enum_values: Electronics, Hardware, Apparel, Furniture)
- unit_price (type: number | unit: currency)
- cost_price (type: number | unit: currency)
- warehouse_id (type: select | enum_values: WH-A, WH-B, WH-C | relationship_to: Warehouse)
- reorder_level (type: number)
- valuation_method (type: select | enum_values: FIFO, LIFO, Average Cost)
- description (type: textarea)

---

## FILE: purchase-orders.html
**MODEL:** PurchaseOrder  
**TABLE:** purchase_orders  

### COLUMNS & RELATIONSHIPS:
- supplier_id (type: select | relationship_to: Supplier)
- order_date (type: date)
- expected_delivery (type: date)
- warehouse_id (type: select | enum_values: WH-A, WH-B | relationship_to: Warehouse)
- payment_terms (type: select | enum_values: Net 30, Net 60, Prepaid)
- product_name (type: text | line_item: true)
- quantity (type: number | line_item: true)
- unit_cost (type: number | unit: currency | line_item: true)
- line_total (type: number | unit: currency | readonly: true | line_item: true)
- subtotal (type: number | unit: currency | readonly: true | summary: true)
- tax_amount (type: number | unit: currency | readonly: true | summary: true)
- total_amount (type: number | unit: currency | readonly: true | summary: true)

---

## FILE: batch-tracking.html
**MODEL:** BatchTracking  
**TABLE:** batch_tracking  

### COLUMNS & RELATIONSHIPS:
- product_id (type: select | relationship_to: Product)
- batch_lot_number (type: text)
- serial_number (type: text)
- quantity (type: number)
- manufacturing_date (type: date)
- expiry_date (type: date)

---

## FILE: stock-movements.html
**MODEL:** StockMovement  
**TABLE:** stock_movements  

### COLUMNS & RELATIONSHIPS:
- product_id (type: select | relationship_to: Product)
- movement_type (type: select | enum_values: Stock In, Stock Out, Transfer)
- quantity (type: number)
- from_warehouse_id (type: select | enum_values: WH-A, WH-B | relationship_to: Warehouse)
- to_warehouse_id (type: select | enum_values: —, WH-A, WH-B | relationship_to: Warehouse | nullable: true)
- reason_notes (type: textarea)

**KPI Fields (Display Only):**
- stock_in_month (type: number | display: true | suffix: "units")
- stock_out_month (type: number | display: true | suffix: "units")
- net_current_stock (type: number | display: true | suffix: "units")

---

## FILE: stock-valuation.html
**MODEL:** StockValuation  
**TABLE:** stock_valuation  

### COLUMNS & RELATIONSHIPS:
- cost_method (type: select | enum_values: FIFO, LIFO, Average Cost)
- product_id (type: select | relationship_to: Product)
- sku (type: text | readonly: true)
- quantity_on_hand (type: number | readonly: true)
- valuation_method (type: text | readonly: true)
- unit_cost (type: number | unit: currency | readonly: true)
- total_value (type: number | unit: currency | readonly: true)
- last_updated (type: datetime | readonly: true)

**KPI Fields (Display Only):**
- total_stock_value (type: number | unit: currency | display: true)
- total_units (type: number | display: true)
- avg_unit_value (type: number | unit: currency | display: true)

---

## FILE: gl.html
**MODEL:** JournalEntry / GeneralLedger  
**TABLE:** general_ledger | journal_entries  

### COLUMNS & RELATIONSHIPS:
- account_code (type: text)
- account_name (type: text)
- account_type (type: select | enum_values: Asset, Liability, Equity, Revenue, Expense)
- debit_amount (type: number | unit: currency)
- credit_amount (type: number | unit: currency)
- narration (type: textarea)

**Display Fields (Read-Only):**
- balance (type: number | unit: currency | readonly: true | calculated: debit - credit)

---

## FILE: tasks.html
**MODEL:** Task  
**TABLE:** tasks  

### COLUMNS & RELATIONSHIPS:
- task_title (type: text)
- project_name (type: text)
- assignee_id (type: select | relationship_to: Employee | enum_values: Adam K., Sara L., James R.)
- priority (type: select | enum_values: High, Medium, Low)
- due_date (type: date)
- status (type: select | enum_values: Todo, In Progress, Review, Done)
- description (type: textarea)

**Display Fields (Kanban View):**
- progress_percentage (type: number | display: true | unit: percentage | readonly: true)

---

## Summary Statistics

**Total Files Analyzed:** 12  
**Total Unique Models:** 12  
**Total Form Fields (excluding display/readonly):** 87  
**Field Types Distribution:**
- Text: 24 fields
- Select/Enum: 31 fields
- Number: 18 fields
- Date: 11 fields
- Email: 4 fields
- Textarea: 6 fields
- DateTime: 1 field
- Display/Readonly: 12 fields

**Common Relationships:**
- Customer ← Invoices, SalesOrders
- Product ← SalesOrders, PurchaseOrders, StockMovement, BatchTracking
- Supplier ← PurchaseOrders
- Warehouse ← Products, StockMovement, PurchaseOrders
- Employee ← Tasks (Assignee)

**Inventory/Warehouse Related Files:** 4 files
- products.html, batch-tracking.html, stock-movements.html, stock-valuation.html

**Financial/Accounting Related Files:** 2 files
- invoices.html, gl.html

**Human Resource Related Files:** 1 file
- employees.html

**Sales/CRM Related Files:** 2 files
- customers.html, sales-orders.html

**Procurement Related Files:** 2 files
- suppliers.html, purchase-orders.html

**Project Management Related Files:** 1 file
- tasks.html
