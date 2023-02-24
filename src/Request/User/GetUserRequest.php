<?php

namespace BeelineOrd\Request\User;

use BeelineOrd\Data\User\UserViewModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<UserViewModel>
 */
class GetUserRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return 'GET /user';
    }

    public function createResponse(array $body): UserViewModel
    {
        return UserViewModel::create($body);
    }

}