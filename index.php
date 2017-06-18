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
        $job_array = explode("\n", str_replace(" ", '', $jobData)); //converting the string to array
        foreach ($job_array as $job) {
            $temp_array = explode("=>", $job);
            $this->$joblist[trim($temp_array[0])] = trim($temp_array[1]);
        }
        if ($this->checkDependencies($this->joblist) === false) { //check if array has the same value for key and value
            return "Jobs can’t depend on themselves.";
        }
    }

    private function jobSequence($key, $value)
    {
    }
    private function checkDependencies($jobArray)
    {
        foreach ($jobArray as $key => $value) {
            if ($key == $value) {
                return false;
            }
        }
    }
}
$job = new Jobs;
$job->getJobs();
