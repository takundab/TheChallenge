<?php
class Jobs
{
    private $jobOutputArray = array();
    private $joblist = array();

    public function getJobs($jobData)
    {
        if (empty($jobData)) {
            return "Empty sequence.";
        }
        $job_array = explode("\n", str_replace(" ", '', $jobData));
        foreach ($job_array as $job) {
            $temp_array = explode("=>", $job);
            $this->$joblist[trim($temp_array[0])] = trim($temp_array[1]);
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
