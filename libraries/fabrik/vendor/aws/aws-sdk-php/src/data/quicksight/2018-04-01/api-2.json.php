<?php
// This file was auto-generated from sdk-root/src/data/quicksight/2018-04-01/api-2.json
return [
    'version'   => '2.0', 'metadata' => ['apiVersion' => '2018-04-01', 'endpointPrefix' => 'quicksight', 'jsonVersion' => '1.0', 'protocol' => 'rest-json', 'serviceFullName' => 'Amazon QuickSight', 'serviceId' => 'QuickSight', 'signatureVersion' => 'v4', 'uid' => 'quicksight-2018-04-01',], 'operations' => [
        'CreateGroup' => ['name' => 'CreateGroup', 'http' => ['method' => 'POST', 'requestUri' => '/accounts/{AwsAccountId}/namespaces/{Namespace}/groups',], 'input' => ['shape' => 'CreateGroupRequest',], 'output' => ['shape' => 'CreateGroupResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceExistsException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'PreconditionNotMetException',], ['shape' => 'LimitExceededException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],], 'CreateGroupMembership' => ['name' => 'CreateGroupMembership', 'http' => ['method' => 'PUT', 'requestUri' => '/accounts/{AwsAccountId}/namespaces/{Namespace}/groups/{GroupName}/members/{MemberName}',], 'input' => ['shape' => 'CreateGroupMembershipRequest',], 'output' => ['shape' => 'CreateGroupMembershipResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'PreconditionNotMetException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],], 'DeleteGroup' => ['name' => 'DeleteGroup', 'http' => ['method' => 'DELETE', 'requestUri' => '/accounts/{AwsAccountId}/namespaces/{Namespace}/groups/{GroupName}',], 'input' => ['shape' => 'DeleteGroupRequest',], 'output' => ['shape' => 'DeleteGroupResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'PreconditionNotMetException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],], 'DeleteGroupMembership' => ['name' => 'DeleteGroupMembership', 'http' => ['method' => 'DELETE', 'requestUri' => '/accounts/{AwsAccountId}/namespaces/{Namespace}/groups/{GroupName}/members/{MemberName}',], 'input' => ['shape' => 'DeleteGroupMembershipRequest',], 'output' => ['shape' => 'DeleteGroupMembershipResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'PreconditionNotMetException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],], 'DeleteUser' => ['name' => 'DeleteUser', 'http' => ['method' => 'DELETE', 'requestUri' => '/accounts/{AwsAccountId}/namespaces/{Namespace}/users/{UserName}',], 'input' => ['shape' => 'DeleteUserRequest',], 'output' => ['shape' => 'DeleteUserResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],], 'DescribeGroup' => ['name' => 'DescribeGroup', 'http' => ['method' => 'GET', 'requestUri' => '/accounts/{AwsAccountId}/namespaces/{Namespace}/groups/{GroupName}',], 'input' => ['shape' => 'DescribeGroupRequest',], 'output' => ['shape' => 'DescribeGroupResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'PreconditionNotMetException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],], 'DescribeUser' => ['name' => 'DescribeUser', 'http' => ['method' => 'GET', 'requestUri' => '/accounts/{AwsAccountId}/namespaces/{Namespace}/users/{UserName}',], 'input' => ['shape' => 'DescribeUserRequest',], 'output' => ['shape' => 'DescribeUserResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],], 'GetDashboardEmbedUrl' => ['name' => 'GetDashboardEmbedUrl', 'http' => ['method' => 'GET', 'requestUri' => '/accounts/{AwsAccountId}/dashboards/{DashboardId}/embed-url',], 'input' => ['shape' => 'GetDashboardEmbedUrlRequest',], 'output' => ['shape' => 'GetDashboardEmbedUrlResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceExistsException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'PreconditionNotMetException',], ['shape' => 'DomainNotWhitelistedException',], ['shape' => 'QuickSightUserNotFoundException',], ['shape' => 'IdentityTypeNotSupportedException',], ['shape' => 'SessionLifetimeInMinutesInvalidException',], ['shape' => 'UnsupportedUserEditionException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],], 'ListGroupMemberships' => ['name' => 'ListGroupMemberships', 'http' => ['method' => 'GET', 'requestUri' => '/accounts/{AwsAccountId}/namespaces/{Namespace}/groups/{GroupName}/members',], 'input' => ['shape' => 'ListGroupMembershipsRequest',], 'output' => ['shape' => 'ListGroupMembershipsResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'InvalidNextTokenException',], ['shape' => 'PreconditionNotMetException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],], 'ListGroups' => ['name' => 'ListGroups', 'http' => ['method' => 'GET', 'requestUri' => '/accounts/{AwsAccountId}/namespaces/{Namespace}/groups',], 'input' => ['shape' => 'ListGroupsRequest',], 'output' => ['shape' => 'ListGroupsResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'InvalidNextTokenException',], ['shape' => 'PreconditionNotMetException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],], 'ListUserGroups' => ['name' => 'ListUserGroups', 'http' => ['method' => 'GET', 'requestUri' => '/accounts/{AwsAccountId}/namespaces/{Namespace}/users/{UserName}/groups',], 'input' => ['shape' => 'ListUserGroupsRequest',], 'output' => ['shape' => 'ListUserGroupsResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],], 'ListUsers' => ['name' => 'ListUsers', 'http' => ['method' => 'GET', 'requestUri' => '/accounts/{AwsAccountId}/namespaces/{Namespace}/users',], 'input' => ['shape' => 'ListUsersRequest',], 'output' => ['shape' => 'ListUsersResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'InvalidNextTokenException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],], 'RegisterUser' => ['name' => 'RegisterUser', 'http' => ['method' => 'POST', 'requestUri' => '/accounts/{AwsAccountId}/namespaces/{Namespace}/users',], 'input' => ['shape' => 'RegisterUserRequest',], 'output' => ['shape' => 'RegisterUserResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'LimitExceededException',], ['shape' => 'ResourceExistsException',], ['shape' => 'PreconditionNotMetException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],], 'UpdateGroup' => ['name' => 'UpdateGroup', 'http' => ['method' => 'PUT', 'requestUri' => '/accounts/{AwsAccountId}/namespaces/{Namespace}/groups/{GroupName}',], 'input' => ['shape' => 'UpdateGroupRequest',], 'output' => ['shape' => 'UpdateGroupResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'PreconditionNotMetException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],], 'UpdateUser' => ['name' => 'UpdateUser', 'http' => ['method' => 'PUT', 'requestUri' => '/accounts/{AwsAccountId}/namespaces/{Namespace}/users/{UserName}',], 'input' => ['shape' => 'UpdateUserRequest',], 'output' => ['shape' => 'UpdateUserResponse',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InvalidParameterValueException',], ['shape' => 'ResourceNotFoundException',], ['shape' => 'ThrottlingException',], ['shape' => 'InternalFailureException',], ['shape' => 'ResourceUnavailableException',],],],
    ], 'shapes' => [
        'AccessDeniedException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 401,], 'exception' => true,], 'Arn' => ['type' => 'string',], 'AwsAccountId' => ['type' => 'string', 'max' => 12, 'min' => 12, 'pattern' => '^[0-9]{12}$',], 'Boolean' => ['type' => 'boolean',], 'CreateGroupMembershipRequest' => ['type' => 'structure', 'required' => ['MemberName', 'GroupName', 'AwsAccountId', 'Namespace',], 'members' => ['MemberName' => ['shape' => 'GroupMemberName', 'location' => 'uri', 'locationName' => 'MemberName',], 'GroupName' => ['shape' => 'GroupName', 'location' => 'uri', 'locationName' => 'GroupName',], 'AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'Namespace' => ['shape' => 'Namespace', 'location' => 'uri', 'locationName' => 'Namespace',],],], 'CreateGroupMembershipResponse' => ['type' => 'structure', 'members' => ['GroupMember' => ['shape' => 'GroupMember',], 'RequestId' => ['shape' => 'String',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',],],], 'CreateGroupRequest' => ['type' => 'structure', 'required' => ['GroupName', 'AwsAccountId', 'Namespace',], 'members' => ['GroupName' => ['shape' => 'GroupName',], 'Description' => ['shape' => 'GroupDescription',], 'AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'Namespace' => ['shape' => 'Namespace', 'location' => 'uri', 'locationName' => 'Namespace',],],], 'CreateGroupResponse' => ['type' => 'structure', 'members' => ['Group' => ['shape' => 'Group',], 'RequestId' => ['shape' => 'String',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',],],], 'DeleteGroupMembershipRequest' => ['type' => 'structure', 'required' => ['MemberName', 'GroupName', 'AwsAccountId', 'Namespace',], 'members' => ['MemberName' => ['shape' => 'GroupMemberName', 'location' => 'uri', 'locationName' => 'MemberName',], 'GroupName' => ['shape' => 'GroupName', 'location' => 'uri', 'locationName' => 'GroupName',], 'AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'Namespace' => ['shape' => 'Namespace', 'location' => 'uri', 'locationName' => 'Namespace',],],], 'DeleteGroupMembershipResponse' => ['type' => 'structure', 'members' => ['RequestId' => ['shape' => 'String',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',],],], 'DeleteGroupRequest' => ['type' => 'structure', 'required' => ['GroupName', 'AwsAccountId', 'Namespace',], 'members' => ['GroupName' => ['shape' => 'GroupName', 'location' => 'uri', 'locationName' => 'GroupName',], 'AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'Namespace' => ['shape' => 'Namespace', 'location' => 'uri', 'locationName' => 'Namespace',],],], 'DeleteGroupResponse' => ['type' => 'structure', 'members' => ['RequestId' => ['shape' => 'String',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',],],], 'DeleteUserRequest' => ['type' => 'structure', 'required' => ['UserName', 'AwsAccountId', 'Namespace',], 'members' => ['UserName' => ['shape' => 'UserName', 'location' => 'uri', 'locationName' => 'UserName',], 'AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'Namespace' => ['shape' => 'Namespace', 'location' => 'uri', 'locationName' => 'Namespace',],],], 'DeleteUserResponse' => ['type' => 'structure', 'members' => ['RequestId' => ['shape' => 'String',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',],],], 'DescribeGroupRequest' => ['type' => 'structure', 'required' => ['GroupName', 'AwsAccountId', 'Namespace',], 'members' => ['GroupName' => ['shape' => 'GroupName', 'location' => 'uri', 'locationName' => 'GroupName',], 'AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'Namespace' => ['shape' => 'Namespace', 'location' => 'uri', 'locationName' => 'Namespace',],],], 'DescribeGroupResponse' => ['type' => 'structure', 'members' => ['Group' => ['shape' => 'Group',], 'RequestId' => ['shape' => 'String',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',],],], 'DescribeUserRequest' => ['type' => 'structure', 'required' => ['UserName', 'AwsAccountId', 'Namespace',], 'members' => ['UserName' => ['shape' => 'UserName', 'location' => 'uri', 'locationName' => 'UserName',], 'AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'Namespace' => ['shape' => 'Namespace', 'location' => 'uri', 'locationName' => 'Namespace',],],], 'DescribeUserResponse' => ['type' => 'structure', 'members' => ['User' => ['shape' => 'User',], 'RequestId' => ['shape' => 'String',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',],],], 'DomainNotWhitelistedException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 403,], 'exception' => true,], 'EmbeddingUrl' => ['type' => 'string', 'sensitive' => true,], 'ExceptionResourceType' => ['type' => 'string', 'enum' => ['USER', 'GROUP', 'NAMESPACE', 'DATA_SOURCE', 'DATA_SET', 'VPC_CONNECTION', 'INGESTION',],], 'GetDashboardEmbedUrlRequest' => ['type' => 'structure', 'required' => ['AwsAccountId', 'DashboardId', 'IdentityType',], 'members' => ['AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'DashboardId' => ['shape' => 'String', 'location' => 'uri', 'locationName' => 'DashboardId',], 'IdentityType' => ['shape' => 'IdentityType', 'location' => 'querystring', 'locationName' => 'creds-type',], 'SessionLifetimeInMinutes' => ['shape' => 'SessionLifetimeInMinutes', 'location' => 'querystring', 'locationName' => 'session-lifetime',], 'UndoRedoDisabled' => ['shape' => 'boolean', 'location' => 'querystring', 'locationName' => 'undo-redo-disabled',], 'ResetDisabled' => ['shape' => 'boolean', 'location' => 'querystring', 'locationName' => 'reset-disabled',],],], 'GetDashboardEmbedUrlResponse' => ['type' => 'structure', 'members' => ['EmbedUrl' => ['shape' => 'EmbeddingUrl',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',], 'RequestId' => ['shape' => 'String',],],], 'Group' => ['type' => 'structure', 'members' => ['Arn' => ['shape' => 'Arn',], 'GroupName' => ['shape' => 'GroupName',], 'Description' => ['shape' => 'GroupDescription',],],], 'GroupDescription' => ['type' => 'string', 'max' => 512, 'min' => 1,], 'GroupList' => ['type' => 'list', 'member' => ['shape' => 'Group',],], 'GroupMember' => ['type' => 'structure', 'members' => ['Arn' => ['shape' => 'Arn',], 'MemberName' => ['shape' => 'GroupMemberName',],],], 'GroupMemberList' => ['type' => 'list', 'member' => ['shape' => 'GroupMember',],], 'GroupMemberName' => ['type' => 'string', 'max' => 256, 'min' => 1, 'pattern' => '[\\u0020-\\u00FF]+',], 'GroupName' => ['type' => 'string', 'min' => 1, 'pattern' => '[\\u0020-\\u00FF]+',], 'IdentityType' => ['type' => 'string', 'enum' => ['IAM', 'QUICKSIGHT',],], 'IdentityTypeNotSupportedException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 403,], 'exception' => true,], 'InternalFailureException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 500,], 'exception' => true, 'fault' => true,], 'InvalidNextTokenException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 400,], 'exception' => true,], 'InvalidParameterValueException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 400,], 'exception' => true,], 'LimitExceededException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'ResourceType' => ['shape' => 'ExceptionResourceType',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 409,], 'exception' => true,], 'ListGroupMembershipsRequest' => ['type' => 'structure', 'required' => ['GroupName', 'AwsAccountId', 'Namespace',], 'members' => ['GroupName' => ['shape' => 'GroupName', 'location' => 'uri', 'locationName' => 'GroupName',], 'NextToken' => ['shape' => 'String', 'location' => 'querystring', 'locationName' => 'next-token',], 'MaxResults' => ['shape' => 'MaxResults', 'box' => true, 'location' => 'querystring', 'locationName' => 'max-results',], 'AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'Namespace' => ['shape' => 'Namespace', 'location' => 'uri', 'locationName' => 'Namespace',],],], 'ListGroupMembershipsResponse' => ['type' => 'structure', 'members' => ['GroupMemberList' => ['shape' => 'GroupMemberList',], 'NextToken' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',],],], 'ListGroupsRequest' => ['type' => 'structure', 'required' => ['AwsAccountId', 'Namespace',], 'members' => ['AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'NextToken' => ['shape' => 'String', 'location' => 'querystring', 'locationName' => 'next-token',], 'MaxResults' => ['shape' => 'MaxResults', 'box' => true, 'location' => 'querystring', 'locationName' => 'max-results',], 'Namespace' => ['shape' => 'Namespace', 'location' => 'uri', 'locationName' => 'Namespace',],],], 'ListGroupsResponse' => ['type' => 'structure', 'members' => ['GroupList' => ['shape' => 'GroupList',], 'NextToken' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',],],], 'ListUserGroupsRequest' => ['type' => 'structure', 'required' => ['UserName', 'AwsAccountId', 'Namespace',], 'members' => ['UserName' => ['shape' => 'UserName', 'location' => 'uri', 'locationName' => 'UserName',], 'AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'Namespace' => ['shape' => 'Namespace', 'location' => 'uri', 'locationName' => 'Namespace',], 'NextToken' => ['shape' => 'String', 'location' => 'querystring', 'locationName' => 'next-token',], 'MaxResults' => ['shape' => 'MaxResults', 'box' => true, 'location' => 'querystring', 'locationName' => 'max-results',],],], 'ListUserGroupsResponse' => ['type' => 'structure', 'members' => ['GroupList' => ['shape' => 'GroupList',], 'NextToken' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',],],], 'ListUsersRequest' => ['type' => 'structure', 'required' => ['AwsAccountId', 'Namespace',], 'members' => ['AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'NextToken' => ['shape' => 'String', 'location' => 'querystring', 'locationName' => 'next-token',], 'MaxResults' => ['shape' => 'MaxResults', 'box' => true, 'location' => 'querystring', 'locationName' => 'max-results',], 'Namespace' => ['shape' => 'Namespace', 'location' => 'uri', 'locationName' => 'Namespace',],],], 'ListUsersResponse' => ['type' => 'structure', 'members' => ['UserList' => ['shape' => 'UserList',], 'NextToken' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',],],], 'MaxResults' => ['type' => 'integer', 'max' => 100000, 'min' => 1,], 'Namespace' => ['type' => 'string', 'pattern' => 'default',], 'PreconditionNotMetException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 400,], 'exception' => true,], 'QuickSightUserNotFoundException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 404,], 'exception' => true,], 'RegisterUserRequest' => ['type' => 'structure', 'required' => ['IdentityType', 'Email', 'UserRole', 'AwsAccountId', 'Namespace',], 'members' => ['IdentityType' => ['shape' => 'IdentityType',], 'Email' => ['shape' => 'String',], 'UserRole' => ['shape' => 'UserRole',], 'IamArn' => ['shape' => 'String',], 'SessionName' => ['shape' => 'String',], 'AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'Namespace' => ['shape' => 'Namespace', 'location' => 'uri', 'locationName' => 'Namespace',], 'UserName' => ['shape' => 'UserName',],],], 'RegisterUserResponse' => ['type' => 'structure', 'members' => ['User' => ['shape' => 'User',], 'UserInvitationUrl' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',],],], 'ResourceExistsException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'ResourceType' => ['shape' => 'ExceptionResourceType',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 409,], 'exception' => true,], 'ResourceNotFoundException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'ResourceType' => ['shape' => 'ExceptionResourceType',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 404,], 'exception' => true,], 'ResourceUnavailableException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'ResourceType' => ['shape' => 'ExceptionResourceType',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 503,], 'exception' => true,], 'SessionLifetimeInMinutes' => ['type' => 'long', 'max' => 600, 'min' => 15,], 'SessionLifetimeInMinutesInvalidException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 400,], 'exception' => true,], 'StatusCode' => ['type' => 'integer',], 'String' => ['type' => 'string',], 'ThrottlingException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 429,], 'exception' => true,], 'UnsupportedUserEditionException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String',], 'RequestId' => ['shape' => 'String',],], 'error' => ['httpStatusCode' => 403,], 'exception' => true,], 'UpdateGroupRequest' => ['type' => 'structure', 'required' => ['GroupName', 'AwsAccountId', 'Namespace',], 'members' => ['GroupName' => ['shape' => 'GroupName', 'location' => 'uri', 'locationName' => 'GroupName',], 'Description' => ['shape' => 'GroupDescription',], 'AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'Namespace' => ['shape' => 'Namespace', 'location' => 'uri', 'locationName' => 'Namespace',],],], 'UpdateGroupResponse' => ['type' => 'structure', 'members' => ['Group' => ['shape' => 'Group',], 'RequestId' => ['shape' => 'String',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',],],], 'UpdateUserRequest' => ['type' => 'structure', 'required' => ['UserName', 'AwsAccountId', 'Namespace', 'Email', 'Role',], 'members' => ['UserName' => ['shape' => 'UserName', 'location' => 'uri', 'locationName' => 'UserName',], 'AwsAccountId' => ['shape' => 'AwsAccountId', 'location' => 'uri', 'locationName' => 'AwsAccountId',], 'Namespace' => ['shape' => 'Namespace', 'location' => 'uri', 'locationName' => 'Namespace',], 'Email' => ['shape' => 'String',], 'Role' => ['shape' => 'UserRole',],],], 'UpdateUserResponse' => ['type' => 'structure', 'members' => ['User' => ['shape' => 'User',], 'RequestId' => ['shape' => 'String',], 'Status' => ['shape' => 'StatusCode', 'location' => 'statusCode',],],], 'User' => ['type' => 'structure', 'members' => ['Arn' => ['shape' => 'Arn',], 'UserName' => ['shape' => 'UserName',], 'Email' => ['shape' => 'String',], 'Role' => ['shape' => 'UserRole',], 'IdentityType' => ['shape' => 'IdentityType',], 'Active' => ['shape' => 'Boolean',],],], 'UserList' => ['type' => 'list', 'member' => ['shape' => 'User',],], 'UserName' => ['type' => 'string', 'min' => 1, 'pattern' => '[\\u0020-\\u00FF]+',], 'UserRole' => ['type' => 'string', 'enum' => ['ADMIN', 'AUTHOR', 'READER', 'RESTRICTED_AUTHOR', 'RESTRICTED_READER',],], 'boolean' => ['type' => 'boolean',],
    ],
];
