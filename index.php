<?php
class Jobs
{
    private $jobOutput = array();
    private $jobarray = array();

    public function getJobs($jobData)
    {
        if (empty($jobData)) {
            return "Empty sequence.";
        }
        $jobs = explode("\n", str_replace(" ", '', $jobData)); //convert job data into key value array
        foreach ($jobs as $job) {
            $value = explode("=>", $job);
            $this->jobarray[trim($value[0])] = trim($value[1]);
        }
        if ($this->checkDependencies($this->jobarray) === true) { //check if array has the same value for key and value
            return "Jobs can’t depend on themselves.";
        }
        foreach ($this->jobarray as $key => $value) {  //check if key value pair exists (if exists - run jobSequen ELSE put key in array)
            if (empty($value) == 0) {
                if (!in_array($key, $this->jobOutput)) {
                    array_push($this->jobOutput, $key);
                }
            } else {
                $this->jobSequence($key, $value);
            }
        }
    }

    private function jobSequence($key, $value)
    {
    }
    private function checkDependencies($keyValueArray)
    {
        foreach ($keyValueArray as $key => $value) {
            if ($key == $value) {
                return true;
            }
        }
    }
}
$n = new Jobs;
$job = "a => b
b => c
c => c
d => a";
echo $n->getJobs($job);
