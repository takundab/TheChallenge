<?php
class Jobs
{
    private $jobs = array();
    private $joblist = array();

    public function getJobs($jobData)
    {
        if (empty($jobData)) {
            return "Empty sequence.";
        }
    }

    private function jobSequence($key, $value)
    {
    }
    private function checkDependencies($keyValueArray)
    {
    }
}
$job = new Jobs;
$job->getJobs();
