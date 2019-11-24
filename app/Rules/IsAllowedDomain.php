<?php

namespace App\Rules;

use App\Entities\Organization;
use App\Services\Domain\OrgService;
use Illuminate\Contracts\Validation\Rule;

class IsAllowedDomain implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
    * Allowed email domains for
    * user registration
    *
    * @var array
    */
    protected $allowedDomains = [];

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $orgs = new OrgService();
        $orgs = $orgs->getOrgByType(Organization::TYPE_DEMAND);
        foreach ($orgs as $org) {
            if ($org->getEmail() !== null) {
                $domain = explode('@', $org->getEmail());
                array_push($this->allowedDomains, $domain[1]);
            }
        }
        $domain = substr(strrchr($value, "@"), 1);
        if (in_array($domain, $this->allowedDomains)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('common.invalid_email_domain');
    }
}
