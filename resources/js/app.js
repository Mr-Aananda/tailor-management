require("./bootstrap");

require("alpinejs");

require("select2");
require("select2/dist/css/select2.min.css");


// add base url into vue
window.baseURL =
    document.head.querySelector('meta[name="base-url"]').content + "/";

// react components
require("./components/Example");

// Template components
require("./components/Template/TemplateCreate");
require("./components/Template/TemplateEdit");

// Contact component
require("./components/Contact/AddPhone");

// Journal component
require("./components/Journal/JournalCreate");

//customer-order component
// require("./components/customer-order/SelectItem");
// require("./components/customer-order/CustomSelect");
require("./components/customer-order/MeasurementDetails");
require("./components/customer-order/Payment");
require("./components/customer-order/LowerMeasurement");
require("./components/customer-order/UpperMeasurement");
require("./components/customer-order/CustomerOrder");
require("./components/Worker/Worker");
require("./components/payroll/WorkerSalary");
require("./components/payroll/EmployeeSalary");
require("./components/Design/AddItem");



// expense
require("./components/Expense/AddSubcategories");
