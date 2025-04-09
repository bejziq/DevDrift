<?php
require_once './JobDao.php';
require_once './CompanyDao.php';
require_once './BaseDao.php';



$jobDao = new JobDao();
$companyDao = new CompanyDao();

// Insert a new user
$jobDao->insert([
    'job_id' => 11,
    'job_name' => 'John Doe',
    'job_description' => 'ovaj posao je najjaci posao...',
    'company_id' => 1
 ]);
 
// Insert a new company
$companyDao->insert([
    'company_id' => 11,
    'company_name' => 'Klika',
    'company_description' => 'ova kompanija posluje od 2020...',
    'address' => 'Butmirska cesta 18d',
    'phone_number' => '+387 61 524 654',
    'web_page' => 'klika.ba'
]);


$jobs = $jobDao->getAll();
print_r($jobs);

$companies = $companyDao->getAll();
print_r($companies);
 

?>